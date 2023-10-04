<?php

namespace Database\Factories\CMS;

use App\Models\CMS\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content'=>$this->faker->sentence,
//            'post_id' =>  Post::all()->random()->value('id') ?? null,
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
