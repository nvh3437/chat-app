<?php

namespace Modules\AvnCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name.required' => 'Tiêu đề không thể bỏ trống',
            'description.required' => 'Nội dung trang không thể bỏ trống',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
