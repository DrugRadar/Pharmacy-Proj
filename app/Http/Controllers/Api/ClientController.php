<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientRegisterRequest;
use App\Http\Requests\Api\ClientUpdateProfileRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\OrderResource;
use App\Models\Client;
use App\Models\Order;
use App\Notifications\ClientVerified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

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

    public function show($id){
        return Client::find($id);
    }
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

    public function clientOrders(Request $request, $id){
        $orders = Order::where('client_id', $id)->get();;
        return response()->json([            
            'data' =>  OrderResource::collection($orders),
        ], 201);

    }
      
}