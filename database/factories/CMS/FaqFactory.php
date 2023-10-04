<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question'=> ['ar'=>$this->faker->sentence,'en'=>$this->faker->sentence],
            'answer' => ['ar'=>$this->faker->paragraph,'en'=>$this->faker->paragraph],
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
