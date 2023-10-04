<?php

use App\Models\Currency;
use App\Models\Employee\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_finances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->string('salary_circle')->nullable();
            $table->double('salary')->default(0);
            $table->integer('work_days_in_week')->default(0);
            $table->integer('work_hours')->default(0);
            $table->string('hour_type')->default(0);
            $table->double('allowances')->default(0);
            $table->double('car_allownce')->default(0);
            $table->double('total')->default(0);
            $table->double('hourly_value')->default(0);
            $table->foreignIdFor(Currency::class)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_finances');
    }
};
