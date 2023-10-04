<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Hr\Shift;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country_id = Country::inRandomOrder()->first()->id;
        return [
            "first_name" => fake()->firstName(),
            "second_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "email" => fake()->email(),
            "phone" => fake()->phoneNumber(),
            "country_id" => $country_id,
            "city_id" => City::where('country_id', $country_id)->inRandomOrder()->first()->id,
            "address" => fake()->address(),
            "user_id" => User::inRandomOrder()->first()->id,
            "shift_id" => Shift::inRandomOrder()->first()->id,
            "draft" => 0,
        ];
    }
}
