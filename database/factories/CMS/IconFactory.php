<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Icon>
 */
class IconFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> ['ar'=>$this->faker->name,'en'=>$this->faker->name],
            'logo'=>$this->faker->imageUrl,
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
