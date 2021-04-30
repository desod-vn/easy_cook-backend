<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            //
            'name' => 'min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Vui lòng nhập tên chuyên mục lớn hơn 6 ký tự.',
        ];
    }
}
