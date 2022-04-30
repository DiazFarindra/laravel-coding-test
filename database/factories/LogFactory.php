<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'log_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'package_id' => Package::factory(),
            'to_package_id' => Package::factory(),
            'total_unit' => $this->faker->randomNumber(3),
        ];
    }
}
