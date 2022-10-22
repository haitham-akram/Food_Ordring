<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Meal_Edit_Request extends FormRequest
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
            'description_ar'=>'required',
            'description_en'=>'required',
            'price'=>'required|numeric',
            'meal_category'=>'required',
            'image_edit'=>'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name_ar.required'=>__('main.meal_name_ar_messages'),
            'name_en.required'=>__('main.meal_name_en_messages'),
            'description_ar.required'=>__('main.meal_description_ar_messages'),
            'description_en.required'=>__('main.meal_description_en_messages'),
            'price.required'=>__('main.meal_price_messages'),
            'price.numeric'=>__('main.meal_price_numeric_messages'),
            'meal_category.required'=>__('main.meal_category_messages'),
        ];
    }
}
