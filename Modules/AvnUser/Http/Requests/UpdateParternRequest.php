<?php

namespace Modules\AvnUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParternRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'exp' => 'required',
            'gender' => 'required',
            // 'email' => 'unique:users',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên chuyên gia không thể bỏ trống',
            'exp.required' => 'Năm kinh nghiệm không thể bỏ trống',
            'gender.required' => 'Giới tính không thể bỏ trống',
            // 'email.unique' => 'Đã có email này',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
