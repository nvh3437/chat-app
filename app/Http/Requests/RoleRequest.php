<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Tên không thể bỏ trống',
            'name.max' => 'Tên tối đa 255 ký tự',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
