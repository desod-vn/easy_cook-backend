<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;


class AuthController extends Controller
{
    // Đăng ký
    public function register(RegisterRequest $request)
    {
        $user = new User;

        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Register success',
        ]);
    }

    // Đăng nhập
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['name' => $request->name, 'password' => $request->password]))
        {
            $user = User::where('name', $request->name)->first();
            $user->token = $user->createToken('App')->accessToken;

            return response()->json([
                'message' => 'Login success',
                'user' => $user,
            ]);
        }
       
        return response()->json([
            'message' => 'Unauthenticated.',
        ]); 
    }

    // Đăng xuất
    public function logout()
    {
        if (Auth::check())
        {
            Auth::user()->token()->revoke();
            return response()->json([
                'message' => 'Logout success',
            ]);
        }
        
    }
}
