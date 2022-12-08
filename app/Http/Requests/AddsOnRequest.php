<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddsOnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name_ar'=>'required',
            'name_en'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'name_ar.required'=>__('main.addsOn_name_ar_messages'),
            'name_en.required'=>__('main.addsOn_name_en_messages'),
        ];
    }
}
