<?php

namespace Database\Factories\Hr;

use App\Models\Hr\Branch;
use App\Models\Hr\Management;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hr\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manager_id' => User::all()->random()->first()->id,
//            'branch_id' => Branch::all()->random()->first()->id,
            'management_id' => Management::all()->random()->first()->id,
//            'manger_name'  => $this->faker->firstName(),
            'name'  => $this->faker->company,
            'type'  => $this->faker->company,
        ];
    }
}
