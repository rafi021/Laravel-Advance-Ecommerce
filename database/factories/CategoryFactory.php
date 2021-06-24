<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_name_en = $this->faker->name();
        $category_name_bn = $this->faker->name();

        return [
            'category_name_en' => $category_name_en,
            'category_name_bn' => $category_name_bn,
            'category_slug_en' => Str::slug($category_name_en),
            'category_slug_bn' => Str::slug($category_name_bn),
            'category_icon' => 'fa fa-shopping-bag',
        ];
    }
}
