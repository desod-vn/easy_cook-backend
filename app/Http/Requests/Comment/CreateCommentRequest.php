<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Nội dung bình luận không được để trống.',
        ];
    }
}
