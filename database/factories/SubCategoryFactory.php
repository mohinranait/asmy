<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->unique()->slug,
            'primary_category_id' => $this->faker->numberBetween($min = 1,$max = 10),
            'image' => $this->faker->imageUrl(100,100),
            'status' => $this->faker->numberBetween(1,0),
        ];
    }
}
