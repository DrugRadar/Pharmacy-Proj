<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientRegisterRequest;
use App\Http\Requests\Api\ClientUpdateProfileRequest;
use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    
    public function register(Request $request)
    {
        
   
        $data = $request->all();
        $avatarImage = $request->file('avatar_image');
        $avatar = $avatarImage->getClientOriginalName();
    
        $avatarImage->storeAs('public/image', $avatar);
        $data['password'] = Hash::make($data['password']);
        $client = new Client();
        $avatar_url = url($avatar);
        $data['avatar_image'] = $avatar_url;
        
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
    public function update(ClientUpdateProfileRequest $request ,$id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validated();
        $client->update($validated);        
        return response()->json([
            'message' => 'Client updated successfully.',
            'data' => $client,
        ]);
    }
}