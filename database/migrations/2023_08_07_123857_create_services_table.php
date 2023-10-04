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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->json('details')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->text('icon')->nullable();
            $table->string('type')->nullable();
            $table->string('order_id')->nullable();
            $table->foreignIdFor(\App\Models\CMS\Category::class);
            $table->boolean('is_featured')->default(0);
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
        Schema::dropIfExists('services');
    }
};
