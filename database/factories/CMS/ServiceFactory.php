<?php

namespace Database\Factories\CMS;

use App\Models\CMS\Category;
use App\Models\CMS\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Entities\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = Project::$types;
        return [
            'name'=> ['ar'=>$this->faker->name,'en'=>$this->faker->name],
            'description' => ['ar'=>$this->faker->paragraph,'en'=>$this->faker->paragraph],
            'type' => $types[rand(0,1)],
            'link' => $this->faker->url ,
            'color' => $this->faker->hexColor() ,
            'icon' => $this->faker->emoji() ,
            'category_id' =>  Category::all()->random()->value('id') ?? null,
            'order_id' => rand(1,6),
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean

        ];
    }
}
