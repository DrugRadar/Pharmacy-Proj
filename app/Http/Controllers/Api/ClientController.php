<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientRegisterRequest;
use App\Http\Requests\Api\ClientUpdateProfileRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Notifications\ClientVerified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

/**
 * @group Client management
 *
 * APIs for managing clients
 */

class ClientController extends Controller
{

    /**
 * Register a new client.
 *
 * @param  \App\Http\Requests\Api\ClientRegisterRequest  $request
 * @return \Illuminate\Http\JsonResponse
 *
 * @bodyParam  name string required The name of the client. Example: John Doe
 * @bodyParam  email string required The email address of the client. Example: john.doe@example.com
 * @bodyParam  password string required The password of the client. Example: secret
 * @bodyParam  phone string required The phone number of the client. Example: +1234567890
 * @bodyParam  avatar_image file required The avatar image of the client.
 *
 * @response {
 *     "message": "Client created successfully",
 *     "data": {
 *         "id": 1,
 *         "name": "John Doe",
 *         "email": "john.doe@example.com",
 *         "phone": "+1234567890",
 *         "avatar_image_url": "https://example.com/storage/avatars/1/avatar.png",
 *         "email_verified_at": null,
 *         "created_at": "2023-04-03T10:00:00.000000Z",
 *         "updated_at": "2023-04-03T10:00:00.000000Z"
 *     }
 * }
 */

    public function register(ClientRegisterRequest $request)
    {


        $data = $request->all();
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $client = new Client();
        $client->addMediaFromRequest('avatar_image')->toMediaCollection('avatar_image');

        $client->fill($validated);
        $client->save();

        if ($client instanceof MustVerifyEmail && ! $client->hasVerifiedEmail()) {
            event(new Registered($client));
        }
        return response()->json([
            'message' => 'Client created successfully',
            'data' => new ClientResource( $client)
        ], 201);
    }

/**
 * Verify a client's email address using a verification hash.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id The ID of the client to verify.
 * @param string $hash The verification hash to check.
 *
 * @return \Illuminate\Http\JsonResponse
 *
 * @throws \Illuminate\Auth\Access\AuthorizationException
 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
 */

    public function verify(Request $request, $id, $hash)
    {
        $client = Client::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($client->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        $client->markEmailAsVerified();
        $client->save();
        $client->notify(new ClientVerified());
        return response()->json([
        'message' => 'Email verified successfully'
    ]);
}

/**
 * Log in a client.
 *
 * @param \Illuminate\Http\Request $request
 * @bodyParam email string required The email of the client.
 * @bodyParam password string required The password of the client.
 * @bodyParam device_name string required The name of the device.
 * @response {
 *     "message": "Client logged in successfully",
 *     "data": {
 *         "user": {
 *             "id": 1,
 *             "name": "John Doe",
 *             "email": "john.doe@example.com",
 *             "avatar_url": "http://example.com/avatar.png",
 *             "created_at": "2022-04-01T15:00:00.000000Z",
 *             "updated_at": "2022-04-01T15:00:00.000000Z"
 *         },
 *         "access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
 *     }
 * }
 * @response 401 {
 *     "message": "Incorrect password"
 * }
 * @response 401 {
 *     "message": "Email not verified"
 * }
 * @response 404 {
 *     "message": "Client not found"
 * }
 */
public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $user = Client::where('email', $email)->first();

    if (!$user) {
        return response()->json(['message' => 'Client not found'], 404);
    }

    if (!Hash::check($password, $user->password)) {
        return response()->json(['message' => 'Incorrect password'], 401);
    }

    if (!$user->hasVerifiedEmail()) {
        return response()->json(['message' => 'Email not verified'], 401);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json([
        'message' => 'Client logged in successfully',
        'data' => [
            'user' => new ClientResource ($user),
            'access_token' => $token,
        ],
    ], 201);
}

/**
 * Get the specified client.
 *
 * @param int $id The ID of the client to retrieve.
 *
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Get(
 *     path="/clients/{id}",
 *     summary="Get a client",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="The ID of the client to retrieve.",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Client found.",
 *         @OA\JsonContent(ref="#/components/schemas/Client")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Client not found.",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Client not found"
 *             )
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * )
 */

    public function show($id){
        return Client::find($id);
    }


    /**
 * Update a client's profile.
 *
 * @OA\Put(
 *     path="/api/clients/{id}",
 *     summary="Update a client's profile",
 *     description="Update a client's profile with the provided information",
 *     operationId="updateClientProfile",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the client to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="first_name",
 *                 type="string",
 *                 description="The client's first name"
 *             ),
 *             @OA\Property(
 *                 property="last_name",
 *                 type="string",
 *                 description="The client's last name"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 description="The client's email address"
 *             ),
 *             @OA\Property(
 *                 property="avatar_image",
 *                 type="string",
 *                 description="The client's avatar image file"
 *             ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="Client updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Client updated successfully."
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/ClientResource"
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Client not found"
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Entity",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="The given data was invalid."
 *             ),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 ref="#/components/schemas/ClientUpdateProfileRequestValidationErrors"
 *             ),
 *         ),
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 */
    public function update(ClientUpdateProfileRequest $request ,$id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validated();
        $client->update($validated);
        $client->addMediaFromRequest('avatar_image')->toMediaCollection('avatar_image');
        return response()->json([
            'message' => 'Client updated successfully.',
            'data' =>new ClientResource( $client),
        ], 202);

    }
}