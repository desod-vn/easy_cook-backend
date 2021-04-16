<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống tên tài khoản.',
            
            'password.confirmed' => 'Vui lòng nhập 2 mật khẩu trùng nhau.',
        ];
    }
}
