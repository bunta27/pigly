<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $targetWeight = $this->faker->randomFloat(1, 50, 80);

        return [
            'target_weight' => $targetWeight,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
