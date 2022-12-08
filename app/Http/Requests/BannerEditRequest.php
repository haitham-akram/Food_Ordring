<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image_edit'=>'nullable',
            'order'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'order.required'=>__('main.order_msg')
        ];
    }
}
