<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRegisterRequest;
use App\Models\Client;
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
        $data['password'] = Hash::make($data['password']);
        $client = new Client();
        $client->fill($data);
        $client->save();

        if ($client instanceof MustVerifyEmail && ! $client->hasVerifiedEmail()) {
            event(new Registered($client));
        }
        return response()->json([
            'message' => 'Client created successfully',
            'data' => $client
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
            'user' => $user,
            'access_token' => $token,
        ],
    ], 201);
}

    public function show($id){
        return Client::find($id);
    }
    public function update(ClientRegisterRequest $request ,$id){
        $client = Client::findOrFail($id);
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'gender' => 'required|in:male,female',
        //     // 'password' => 'nullable|string|min:8|confirmed',
        //     'date_of_birth' => 'required|date|before_or_equal:today',
        //     // 'profile_image' => 'nullable|image|max:2048',
        //     'mobile_number' => 'required|string|max:20',
        //     'national_id' => 'required|string|max:20|unique:clients,national_id,' . $client->id,
        // ]);
        $client->update($request);        
        return response()->json([
            'message' => 'Client updated successfully.',
            'data' => $client,
        ]);
    }
}