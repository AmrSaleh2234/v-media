<?php

namespace Database\Factories\CMS;

use App\Models\CMS\Category;
use App\Models\CMS\ProjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Entities\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CMS\CompanyProject>
 */
class CompanyProjectFactory extends Factory
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
            'title'=> ['ar'=>$this->faker->sentence,'en'=>$this->faker->sentence],
            'description' => ['ar'=>$this->faker->paragraph,'en'=>$this->faker->paragraph],
            'link' => $this->faker->url,
            'main_image' => $this->faker->imageUrl,
            'project_type_id' =>  ProjectType::all()->random()->value('id') ?? null,
            'app' => $this->faker->boolean,
            'website' => $this->faker->boolean
        ];
    }
}
