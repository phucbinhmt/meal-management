<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'user_id' => 'required|numeric|digits:8|unique:users,user_id',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'birth_date' => 'required|date|before:today',
            'phone' => 'required|regex:/^0\d{9,10}$/',
            'email' => 'required|email|unique:users,email',
            'address_id' => 'required|exists:addresses,address_id',
            'position_id' => 'required|exists:positions,position_id|not_in:1',
            'image_upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'user_id' => 'Mã nhân viên không hợp lệ',
            'last_name' => 'Họ nhân viên không hợp lệ',
            'first_name' => 'Tên nhân viên không hợp lệ',
            'gender' => 'Giới tính không hợp lệ',
            'birth_date' => 'Ngày sinh không hợp lệ',
            'phone' => 'Số điện thoại không hợp lệ',
            'email' => 'Email không hợp lệ',
            'address_id' => 'Địa chỉ không hợp lệ',
            'position_id' => 'Chức vụ không hợp lệ',
            'image_upload' => 'Hình ảnh không hợp lệ',
        ];
    }
}
