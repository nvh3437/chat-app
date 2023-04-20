<?php

namespace Modules\AvnService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề không thể bỏ trống',
            'price.required' => 'Giá cả không thể bỏ trống',
            'description.required' => 'Thông tin dịch vụ không thể bỏ trống',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
