<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFinanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "employee_id" => Employee::inRandomOrder()->first()->id,
            "salary_circle" => 'month',
            "salary" => rand(1000,10000),
            "work_days_in_week" => rand(2,7),
            "work_hours" => rand(4,9),
            "hour_type" => 0,
            "salary" => rand(1000,10000),
            "allowances" => rand(1000,10000),
            "car_allownce" => rand(1000,10000),
            "total" => rand(1000,10000),
            "hourly_value" => rand(4,9),
            "currency_id" => Currency::inRandomOrder()->first()->id,
        ];
    }
}
