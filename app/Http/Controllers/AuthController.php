<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    
    // Register function
    public function register(Request $req){

        $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password)
        ]);

        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);

    }

    //Login function
    public function login(Request $req){

        $email = $req->email;
        $password = $req->password;

        $user = User::where('email', $email)->first();

        if(!$user || !Hash::check($password, $user->password)){

            return response('user not found', 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);
        
    }

    // Logout function
    public function logout(Request $req){

        auth()->user()->tokens()->delete();
        return response('Logged out succesfully', 200);

    }
}
