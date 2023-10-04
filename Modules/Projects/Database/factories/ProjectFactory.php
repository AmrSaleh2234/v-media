<?php
namespace Modules\Projects\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Projects\Entities\Project;


class ProjectFactory extends Factory
{
protected $model = Project::class;

/**
* Define the model's default state.
* @return array
*/
    public function definition()
    {
        return [
            'name' => $this->faker->name ,
            'code' => $this->faker->numerify(),
            'number' => $this->faker->numerify(),
            'description' => $this->faker->text(),
            'start_date'  => $this->faker->dateTime(),
            'type' => Project::$types[rand(0,2)],
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'client_id' => 1,
        ];
    }
}



