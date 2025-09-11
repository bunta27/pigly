<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $minutes = $this->faker->numberBetween(0, 180);

        return [

        'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        'weight' => $this->faker->randomFloat(1, 40, 120),
        'calories' => $this->faker->numberBetween(1500, 3000),
        'exercise_time' => sprintf('%02d:%02d:00', intdiv($minutes, 60), $minutes % 60),
        'exercise_content' => $this->faker->randomElement(['ランニング', '筋トレ', 'ヨガ', '水泳']),
        'created_at' => now(),
        'updated_at' => now(),

        ];
    }
}
