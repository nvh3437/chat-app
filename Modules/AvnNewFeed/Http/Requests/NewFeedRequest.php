<?php

namespace Modules\AvnNewFeed\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewFeedRequest extends FormRequest
{
    public function rules()
    {
        return [
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Nội dung không thể bỏ trống',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
