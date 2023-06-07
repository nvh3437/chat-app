<?php

namespace Modules\AvnUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class StoreProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'unique:users',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('settings.Auth.Validate.name.Required'),
            'username.required' => Lang::get('settings.Auth.Validate.username.Required'),
            'username.unique' => Lang::get('settings.Auth.Validate.username.Unique'),
            'email.unique' => Lang::get('settings.Auth.Validate.email.Unique'),
        ];
    }

    public function authorize()
    {
        return true;
    }
}