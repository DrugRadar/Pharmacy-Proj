<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function register(Request $request)
    {
        $data = $request->all();
        $client = new Client();
        $client->fill($data);
        $client->save();

        return response()->json([
            'message' => 'Client created successfully',
            'data' => $client
        ], 201);
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
    public function show($id){
        return Client::find($id);
    }
    
}