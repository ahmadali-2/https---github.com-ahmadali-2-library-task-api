<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name" => "required|min:3",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
        ]);

        User::insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "type" => "user",
        ]);

        return response()->json([
            "message" => "User registered successfuly!",
        ],200);
    }

    public function login(Request $request){

        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where(['email'=>$request->email])->first();

        if(Hash::check($request->password,$user->password)){
            $authToken = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "message" => "Login successfully!",
                "type" => $user->type,
                "auth_token" => $authToken,
            ],200);
        }

        return response()->json([
            "message" => "Login faild, please try again!",
        ],400);

    }
}
