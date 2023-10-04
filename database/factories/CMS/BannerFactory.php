<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'path' => $this->faker->imageUrl,
            'description' => $this->faker->paragraph,
            'link' => $this->faker->url,
            'order_id' => rand(1,5),
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
