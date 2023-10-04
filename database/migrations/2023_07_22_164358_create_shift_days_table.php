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
        Schema::create('shift_days', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Hr\Shift::class);
            $table->string('day_name')->nullable();
            $table->string('start_in')->nullable();
            $table->string('end_in')->nullable();
            //allow to late in minutes
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_days');
    }
};
