<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'content' => 'required|min:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'category_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên công thức không được để trống.',
            'name.min' => 'Tên công thức phải chứa ít nhất :min ký tự.',
            'name.max' => 'Tên công thức chứa nhiều nhất :max ký tự.',

            'content.required' => 'Nội dung công thức không được để trống.',
            'content.min' => 'Nội dung công thức phải chứa ít nhất :min ký tự.',

            'image.image' => 'Ảnh không hợp lệ',
            'image.mimes' => 'Chỉ hỗ trợ định dạng:jpeg,png,jpg,gif,svg',
            'image.max' => 'Vui lòng upload ảnh có dung lượng nhỏ hơn :max kb',

            'category_id.required' => 'Vui lòng nhập thư mục cho công thức.',
            'category_id.numeric' => 'Vui lòng nhập thư mục cho công thức.',
            
        ];
    }
}
