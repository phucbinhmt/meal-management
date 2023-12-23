<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dish_name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'dish_type_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dish_name' => 'Tên món ăn không hợp lệ',
            'description' => 'Mô tả không hợp lệ',
            'image' => 'Hình ảnh không hợp lệ',
            'price' => 'Giá món ăn không hợp lệ',
            'dish_type_id' => 'Loại món ăn không hợp lệ',
        ];
    }
}
