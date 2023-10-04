<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name'=>$this->faker->name,
            'title'=>$this->faker->name,
            'type' =>$this->faker->company,
            'link' => $this->faker->url ,
            'active' => $this->faker->boolean
        ];
    }
}
