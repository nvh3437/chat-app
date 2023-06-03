<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

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
            'name.required' => Lang::get('settings.Role.Validate.name.Required'),
            'name.max' => Lang::get('settings.Role.Validate.name.Max'),
        ];
    }

    public function authorize()
    {
        return true;
    }
}