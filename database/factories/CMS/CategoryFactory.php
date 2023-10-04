<?php

namespace Database\Factories\CMS;

use App\Models\CMS\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = Category::$types;
        return [
            'name'=> ['ar'=>$this->faker->name,'en'=>$this->faker->name],
            'type' => $types[array_rand($types,1)],
            'active' => $this->faker->boolean
        ];
    }
}
