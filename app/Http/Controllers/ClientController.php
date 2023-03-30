<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Event;
class ClientController extends Controller
{
    
    public function register(Request $request)
    {
        $data = $request->all();
        $client = new Client();
        $client->fill($data);
        $client->save();
        $options = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
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
    
        $user = Client::where('email', $email)
                      ->where('password', $password)
                      ->first();
    
        if ($user) {
            return response()->json([
                'message' => 'Client logged in successfully',
                'data' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error in login. Password or name are incorrect.',
                'data' => null
            ], 404);
        }
    }
    
}