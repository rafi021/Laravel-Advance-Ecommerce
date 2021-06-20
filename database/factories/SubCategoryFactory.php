<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $category_id = 1;
            $subcategory_name_en = $this->faker->name();
            $subcategory_name_bn = $this->faker->name();
        return [
            'category_id' => $category_id,
            'subcategory_name_en' => $subcategory_name_en,
            'subcategory_name_bn' => $subcategory_name_bn,
            'subcategory_slug_en' => Str::slug($subcategory_name_en),
            'subcategory_slug_bn' => Str::slug($subcategory_name_bn),
            ];
    }
}
