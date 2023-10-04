<?php

namespace Database\Factories\Hr;

use App\Models\Country;
use App\Models\Hr\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hr\Management>
 */
class ManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image =  $this->faker->imageUrl();

        return [
//            'user_id' => User::all()->random()->first()->id,
            'manager_id' => User::all()->random()->first()->id,
            'branch_id' => Branch::all()->random()->first()->id,
            'name'  => $this->faker->company,
            'type'  => $this->faker->company,
//            'phone'  => $this->faker->phoneNumber,
//            'image'  => $image,
//            'attachment'  => $image,
//            'status'  => $this->faker->randomElement(['active','inactive']),
//            'country_id' => Country::all()->random()->first()->id,
            'active'  => $this->faker->boolean,
            'note'  => $this->faker->paragraph(),
        ];
    }
}
