<?php

namespace Modules\AvnCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class CMSRequest extends FormRequest
{
    public function rules()
    {
        return [
            'link' => 'unique:avn_cms',
        ];
    }

    public function messages()
    {
        return [
            'link.unique' => Lang::get('settings.Validate.Unique', ['name' => Lang::get('settings.Route')]),
        ];
    }

    public function authorize()
    {
        return true;
    }
}
