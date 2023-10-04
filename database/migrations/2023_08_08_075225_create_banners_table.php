<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->string('image');
            $table->json('description')->nullable();
            $table->string('type')->nullable();
            $table->smallInteger('order_id')->nullable();
            $table->string('link')->nullable();
            $table->boolean('app')->default(0);
            $table->boolean('website')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
