<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'slider_name' => 'required',
            'slider_title' => 'nullable',
            'slider_description' => 'nullable',
            'slider_image' => 'required|mimes:png,jpg',
            'slider_status' => 'boolean',
        ];
    }
}
