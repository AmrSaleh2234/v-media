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
        Schema::create('employee_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->string('name')->nullable();
            $table->string('course_from')->nullable();
            $table->string('duration')->nullable();
            $table->date('date')->nullable();
            $table->string('certificate_photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_courses');
    }
};
