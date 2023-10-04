<?php

namespace Database\Factories\Hr;

use App\Models\City;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Hr\Branch;
use App\Models\Hr\Shift;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hr\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'manager_id' => User::all()->random()?->value('id') ?? null,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->email,
            'type' => Arr::random(Branch::$types),
            'city_id' =>  City::all()->random()->first()->id,
            'is_clients' => $this->faker->boolean,
            'is_mangers' => $this->faker->boolean,
            'is_services' => $this->faker->boolean,
            'is_papers' => $this->faker->boolean,
            'is_projects' => $this->faker->boolean,
            'is_shifts' => $this->faker->boolean,
//            'image' => $this->faker->imageUrl(),
//            'attachment' => $this->faker->imageUrl(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'active' => $this->faker->boolean,
        ];
    }
}
