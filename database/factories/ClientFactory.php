<?php

namespace Database\Factories;


use App\Models\Broker;
use App\Models\Country;
use App\Models\Hr\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'phone_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'branch_id' => Branch::all()->random()->value('id') ?? null,
            'broker_id' => null,
            'register_number' => $this->faker->numerify,
            'agent_name' => $this->faker->name,

            'card_id' => $this->faker->creditCardNumber,
            'card_image' => $this->faker->imageUrl(),
//            'passport_id' => $this->faker->numerify(),
//            'passport_image' => $this->faker->imageUrl(),
            'gender' =>  $this->faker->randomElement(['male','female']),
            'birth_date' =>  $this->faker->dateTime(),
//            'country_id' => Country::all()->random()->value('id') ?? null,
            'active'  => $this->faker->boolean,
            'note'  => $this->faker->paragraph(),
        ];
    }
}
