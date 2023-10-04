<?php
namespace Modules\Projects\Database\factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\Task;


class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name ,
            'start_date' => $this->faker->dateTimeThisMonth ,
            'city_id' => City::all()->random()->first(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'duration'  => $this->faker->numberBetween(1,100),
//            'expected_date'  => $this->faker->dateTimeThisMonth(),
            'actual_date'  => $this->faker->dateTimeThisMonth(now()->addMonth(1)),
//            'status_id' =>$statses->random(),
        ];
    }
}



