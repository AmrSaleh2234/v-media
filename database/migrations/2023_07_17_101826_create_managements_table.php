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
        Schema::create('managements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->foreignIdFor(\App\Models\Hr\Branch::class);
            $table->foreignId('manager_id')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->foreignId('parent_id')
                ->nullable()
                ->references('id')
                ->on('managements');
            $table->mediumText('note')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managements');
    }
};
