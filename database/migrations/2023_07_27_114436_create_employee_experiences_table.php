<?php

use App\Models\Employee\Employee;
use App\Models\Hr\JobName;
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
        Schema::create('employee_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee ::class);
            $table->string('company_name')->nullable();
            $table->foreignIdFor(JobName::class)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->integer('no_of_years')->nullable();
            $table->string('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_experiences');
    }
};
