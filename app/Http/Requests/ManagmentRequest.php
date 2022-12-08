<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagmentRequest extends FormRequest
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
            'maximum_range'=>'required|numeric',
            'price_kilometer'=>'required|numeric',
            'start_calculating'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'start_calculating.required'=>__('main.start_calculating_messages'),
            'start_calculating.numeric'=>__('main.start_calculating_numeric_messages'),
            'price_kilometer.required'=>__('main.price_kilometer_messages'),
            'price_kilometer.numeric'=>__('main.price_kilometer_numeric_messages'),
            'maximum_range.required'=>__('main.maximum_range_messages'),
            'maximum_range.numeric'=>__('main.maximum_range_numeric_messages'),

        ];
    }
}
