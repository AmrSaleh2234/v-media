<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from_id' => User::all()->random()->value('id'),
//            'to_id' => User::all()->random()->first()->id,
            'content' => $this->faker->paragraph,
            'public' => $this->faker->boolean,
//            'type' => 'message',
        ];
    }
}
