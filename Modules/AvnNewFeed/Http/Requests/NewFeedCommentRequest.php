<?php

namespace Modules\AvnNewFeed\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'comment.required' => 'Bình luận không thể bỏ trống',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
