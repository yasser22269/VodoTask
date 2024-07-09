<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password') && $request->filled('password') == $request->filled('password_confi')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['data'=> $user,'message' => 'Profile updated successfully.']);
    }
}
