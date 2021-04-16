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
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Vui lòng nhập tên thư mục lớn hơn 6 ký tự.',

            'image.image' => 'Vui lòng chỉ upload file ảnh.',
            'image.mimes' => 'Vui lòng xem lại định dạng ảnh, chỉ hỗ trợ :jpeg,jpg,png.',
            'image.max' => 'Vui lòng chỉ upload ảnh dưới :max kb.',
        ];
    }
}
