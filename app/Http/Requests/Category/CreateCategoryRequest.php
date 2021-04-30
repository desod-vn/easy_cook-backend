<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            //
            'name' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống tên chuyên mục.',
            'name.min' => 'Vui lòng nhập tên chuyên mục lớn hơn :min ký tự.',
        ];
    }
}
