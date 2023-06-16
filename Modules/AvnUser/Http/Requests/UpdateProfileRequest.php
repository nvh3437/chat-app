<?php

namespace Modules\AvnUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'unique:users,email,' . $this->email,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('settings.Auth.Validate.name.Required'),
            'email.unique' => Lang::get('settings.Auth.Validate.email.Unique'),
        ];
    }

    public function authorize()
    {
        return true;
    }
}