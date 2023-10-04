<?php

use App\Models\Employee\Employee;
use App\Models\Hr\JobGrade;
use App\Models\Hr\JobName;
use App\Models\Hr\JobType;
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
        Schema::create('employment_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(JobGrade::class)->nullable();
            $table->foreignIdFor(JobName::class)->nullable();
            $table->foreignIdFor(JobType::class)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_data');
    }
};
