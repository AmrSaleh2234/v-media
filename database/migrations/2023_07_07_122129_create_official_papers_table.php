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
        Schema::create('official_papers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->nullable();
            $table->string('way_to_send')->default('phone')->comment('phone, email');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_papers');
    }
};
