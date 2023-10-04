<?php

namespace Database\Factories\CMS;

use App\Models\CMS\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  User::all()->random()->value('id') ?? null,
            'title'=> $this->faker->unique()->name,
            'content'=> $this->faker->paragraph,
//            'type' => array_rand($types,1),
            'link' => $this->faker->url ,
            'category_id' =>  Category::all()->random()->value('id') ?? null,
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
