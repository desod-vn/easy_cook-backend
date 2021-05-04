<?php

namespace App\Http\Requests\Ingredient;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:ingredients',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nguyên liệu',
            'name.unique' => 'Tên nguyên liệu đã tồn tại, vui lòng kiểm tra lại.'
        ];
    }
}
