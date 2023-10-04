<?php

namespace Database\Factories\Hr;

use App\Models\Hr\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hr\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'distance' => $this->faker->randomFloat(2, 0, 1000),
            'note' => $this->faker->text,
        ];
    }
}
