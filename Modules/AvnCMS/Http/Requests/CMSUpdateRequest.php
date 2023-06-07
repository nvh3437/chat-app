<?php

namespace Modules\AvnCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class CMSUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('settings.Validate.Required', ['name' => Lang::get('settings.Title')]),
            'description.required' => Lang::get('settings.Validate.Required', ['name' => Lang::get('settings.Category')]),
        ];
    }

    public function authorize()
    {
        return true;
    }
}