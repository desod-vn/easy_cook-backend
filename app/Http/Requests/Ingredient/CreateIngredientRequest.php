<?php

namespace App\Http\Requests\Ingredient;

use Illuminate\Foundation\Http\FormRequest;

class CreateIngredientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:ingredients',
            'unit' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nguyên liệu.',
            'name.unique' => 'Tên nguyên liệu đã tồn tại, vui lòng kiểm tra lại.',

            'unit.required' => 'Vui lòng nhập đơn vị tính cho nguyên liệu.',
        ];
    }
}
