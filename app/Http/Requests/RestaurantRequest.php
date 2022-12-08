<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'logo'=>'required',
            'cover_image'=>'nullable',
            'category_id'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',


        ];
    }
    public function messages()
    {
        return [
            'name_ar.required'=>__('main.restaurant_name_ar_messages'),
            'name_en.required'=>__('main.restaurant_name_en_messages'),
            'description_ar.required'=>__('main.restaurant_description_ar_messages'),
            'description_en.required'=>__('main.restaurant_description_en_messages'),
            'logo.required'=>__('main.logo_messages'),
//            'cover_image.required'=>__('main.cover_image_messages'),
            'category_id.required'=>__('main.category_id_messages'),
            'latitude.required'=>__('main.latitude_messages'),
            'longitude.required'=>__('main.longitude_messages'),


        ];
    }
}
