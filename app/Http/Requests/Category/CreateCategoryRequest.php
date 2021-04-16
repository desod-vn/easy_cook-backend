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
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống tên thư mục.',
            'name.min' => 'Vui lòng nhập tên thư mục lớn hơn :min ký tự.',

            'image.required' => 'Vui lòng không bỏ trống ảnh thư mục.',
            'image.image' => 'Vui lòng chỉ upload file ảnh.',
            'image.max' => 'Vui lòng chỉ upload ảnh dưới :max kb.',
            'image.mimes' => 'Vui lòng xem lại định dạng ảnh, chỉ hỗ trợ :jpeg,jpg,png.',
        ];
    }
}
