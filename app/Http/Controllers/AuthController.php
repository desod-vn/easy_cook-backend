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
        $user->token = $user->createToken('App')->accessToken;

        return response()->json([
            'message' => 'Đăng ký thành công.',
            'status' => true,
            'user' => $user,
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
                'message' => 'Đăng nhập thành công.',
                'status' => true,
                'user' => $user,
            ]);
        }
       
        return response()->json([
            'message' => 'Tên tài khoản hoặc mật khẩu không chính xác.',
            'status' => false,
        ]); 
    }

    // Đăng xuất
    public function logout()
    {
        if (Auth::check())
        {
            Auth::user()->token()->revoke();
            return response()->json([
                'message' => 'Đăng xuất thành công.',
                'status' => true,
            ]);
        }
    }

    // Thông tin
    public function information()
    {
        $user = Auth::user();

        return response()->json([
            'status' => true,
            'user' => $user,
        ]); 
    }

    // Avatar
    public function avatar(Request $request, User $user)
    {
        $link = 'http://localhost:8000/';
        if($request->has('image'))
        {
            $image = $request->file('image')->store('images');
            $user->image = $link . $image;
        }
        $user->save();

        return response()->json([
            'message' => 'Update success',
            'status' => true,
            $user->image,
        ]);

    }
}
