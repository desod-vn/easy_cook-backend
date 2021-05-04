<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:posts',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên công thức không được để trống.',
            'name.unique' => 'Một công thức đã được tạo trước đó, vui lòng sửa lại công thức đó trước khi tạo mới.',
        ];
    }
}
