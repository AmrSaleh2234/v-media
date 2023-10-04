<?php

namespace Database\Factories\CMS;

use App\Models\CMS\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> ['ar'=>$this->faker->sentence,'en'=>$this->faker->sentence],
            'content'=> ['ar'=>$this->faker->paragraph,'en'=>$this->faker->paragraph],
            'image' => $this->faker->imageUrl,
            'category_id' => Category::all()->random()->value('id') ?? null,
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
