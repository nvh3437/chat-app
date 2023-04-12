<?php

namespace Modules\AvnPost\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề không thể bỏ trống',
            'category_id.required' => 'Danh mục không thể bỏ trống',
            'description.required' => 'Nội dung không thể bỏ trống',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
