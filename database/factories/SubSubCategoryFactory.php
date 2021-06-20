<?php

namespace Database\Factories;

use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubSubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubSubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_id = 1;
        $subcategory_id = 1;
        $subsubcategory_name_en = $this->faker->name();
        $subsubcategory_name_bn = $this->faker->name();
    return [
        'category_id' => $category_id,
        'subcategory_id' => $subcategory_id,
        'subsubcategory_name_en' => $subsubcategory_name_en,
        'subsubcategory_name_bn' => $subsubcategory_name_bn,
        'subsubcategory_slug_en' => Str::slug($subsubcategory_name_en),
        'subsubcategory_slug_bn' => Str::slug($subsubcategory_name_bn),
        ];
    }
}
