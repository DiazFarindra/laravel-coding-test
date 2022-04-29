<?php

namespace Database\Factories;

use App\Models\Pond;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pond_id' => Pond::factory(),
            'package_code' => $this->faker->unique()->randomNumber(7),
            'total_unit' => $this->faker->randomNumber(3),
        ];
    }
}
