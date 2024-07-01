<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['message' => 'User registered successfully.','user' => $user , "token" =>$token]);
    }

    public function login(LoginRequest $request)
    {
        $user =User::where('username',$request->username)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('API Token')->plainTextToken;

                return response()->json(['message' => 'User Logged successfully.','user' => $user , "token" =>$token]);
            }else
                return response()->json(['message' => 'Data do not match our records.']);
        }else{
            return response()->json(['message' => 'Data do not match our records.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'User Logged out successfully.']);
    }
}
