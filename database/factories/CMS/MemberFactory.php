<?php

namespace Database\Factories\CMS;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Member>
 */
class MemberFactory extends Factory
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
            'job_title'=> ['ar'=>$this->faker->jobTitle,'en'=>$this->faker->jobTitle],
            'image' => $this->faker->imageUrl,
            'bio' => ['ar'=>$this->faker->paragraph,'en'=>$this->faker->paragraph],
            'description' => ['ar'=>$this->faker->paragraph,'en'=>$this->faker->paragraph],
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
