<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
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
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_phone' => 'required',
            'shipping_postCode' => 'required',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'shipping_address' => 'required',
            'shipping_notes' => 'nullable',
            'payment_method' => 'required',
        ];
    }
}
