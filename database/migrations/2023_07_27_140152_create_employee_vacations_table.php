<?php

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
        Schema::create('employee_vacations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->date('date_of_hiring')->nullable();
            $table->date('due_date')->nullable();
            $table->string('mechanism_before_duration')->nullable();
            $table->string('vacation_credit')->nullable();
            $table->string('work_duration')->nullable();
            $table->string('vacation_deduction')->nullable();
            $table->string('without_warning')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_vacations');
    }
};
