<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upzila>
 */
class UpzilaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'slug'=>$this->faker->unique()->slug,
            'district_id'=>$this->faker->numberBetween($min=1, $max=10),
            'status'=>$this->faker->numberBetween(1,0),
        ];
    }
}
