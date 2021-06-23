<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slider_name' => 'Main-Slider',
            'slider_title' => $this->faker->numberBetween(1,20).'% Flat Discount',
            'slider_description' => $this->faker->paragraph(),
            'slider_image' => 'https://source.unsplash.com/random',
            'slider_status' => $this->faker->boolean,
        ];
    }
}
