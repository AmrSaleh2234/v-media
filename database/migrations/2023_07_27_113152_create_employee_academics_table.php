<?php

use App\Models\Employee\Employee;
use App\Models\Hr\University;
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
        Schema::create('employee_academics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(University::class)->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->date('qualification_date')->nullable();
            $table->string('qualification_photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_academics');
    }
};
