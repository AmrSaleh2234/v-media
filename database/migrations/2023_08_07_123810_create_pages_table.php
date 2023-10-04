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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('name')->unique();
            $table->text('title')->nullable();
            $table->text('data')->nullable();
            $table->string('link')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('parent_id')
                ->nullable()
                ->references('id')
                ->on('pages')
                ->onUpdate('cascade');
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
