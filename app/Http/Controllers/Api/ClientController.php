<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    
}