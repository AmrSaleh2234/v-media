<?php

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
        Schema::create('job_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Hr\Grade::class);
            $table->foreignIdFor(\App\Models\Hr\JobType::class);
            $table->mediumText('description')->nullable();
            $table->decimal('salary',10,2)->nullable();
            $table->smallInteger('years')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_grades');
    }
};
