<?php

namespace Modules\AvnNewFeed\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class NewFeedCommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => Lang::get('settings.Validate.Required', ['name' => Lang::get('settings.Comment')]),
        ];
    }

    public function authorize()
    {
        return true;
    }
}