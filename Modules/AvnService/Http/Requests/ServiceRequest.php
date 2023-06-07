<?php

namespace Modules\AvnService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => Lang::get('settings.Validate.Required', ['name' => Lang::get('settings.Price')]),
        ];
    }

    public function authorize()
    {
        return true;
    }
}