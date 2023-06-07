<?php

namespace Modules\AvnPost\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => Lang::get('settings.Validate.Required', ['name' => Lang::get('settings.Category')]),
        ];
    }

    public function authorize()
    {
        return true;
    }
}