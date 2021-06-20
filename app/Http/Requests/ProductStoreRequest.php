<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'brand_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'sub_subcategory_id' => 'required|numeric',
            'product_name_en' => 'required',
            'product_name_bn' => 'required',
            'product_code' => 'nullable',
            'product_qty' => 'required|numeric',
            'product_tags_en' => 'nullable',
            'product_tags_bn' => 'nullable',
            'product_size_en' => 'nullable',
            'product_size_bn' => 'nullable',
            'product_color_en' => 'nullable',
            'product_color_bn' => 'nullable',
            'purchase_price' => 'numeric|nullable',
            'selling_price' => 'required|numeric',
            'discount_price' => 'numeric|nullable',
            'short_description_en' => 'nullable',
            'short_description_bn' => 'nullable',
            'long_description_en' => 'nullable',
            'long_description_bn' => 'nullable',
            'product_thumbnail' => 'required|mimes:png,jpg',
            'product_images' => 'nullable',
            'hot_deals' => 'nullable',
            'featured' => 'nullable',
            'new_arrival' => 'nullable',
            'special_offer' => 'nullable',
            'special_deals' => 'nullable',
            'status' => 'nullable',
        ];
    }
}
