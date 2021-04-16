<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống tên tài khoản.',
            'name.unique' => 'Tên tài khoản đã tồn tại, vui lòng kiểm tra lại.',

            'email.required' => 'Vui lòng không bỏ trống địa chỉ email.',
            'email.email' => 'Vui lòng nhập chính xác địa chỉ email.',
            'email.unique' => 'Địa chỉ email đã tồn tại, vui lòng kiểm tra lại.',

            'password.required' => 'Vui lòng không bỏ trống mật khẩu.',
            'password.min' => 'Vui lòng nhập mật khẩu lớn hơn :min ký tự.',
            'password.confirmed' => 'Vui lòng nhập 2 mật khẩu trùng nhau.',
        ];
    }
}
