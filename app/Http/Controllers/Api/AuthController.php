<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{



    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user)
            throw ValidationException::withMessages([
                'email' => ['email not correct']
            ]);


        if (!Hash::check($request->password, $user->password))
            throw ValidationException::withMessages([
                'email' => ['email not correct']
            ]);


        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }


    public function logout(Request $request) {}




}
