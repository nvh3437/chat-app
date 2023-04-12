<?php

namespace Modules\AvnCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CMSRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'link' => 'unique:avn_cms',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề không thể bỏ trống',
            'description.required' => 'Nội dung trang không thể bỏ trống',
            'link.unique' => 'Đã có đường dẫn này',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
