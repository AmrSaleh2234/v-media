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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('manager_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');
            $table->foreignIdFor(\App\Models\City::class);
            $table->foreignIdFor(\App\Models\Hr\Shift::class)->nullable();
            $table->tinyInteger('is_clients')->default(0);
            $table->tinyInteger('is_mangers')->default(0);
            $table->tinyInteger('is_services')->default(0);
            $table->tinyInteger('is_papers')->default(0);
            $table->tinyInteger('is_projects')->default(0);
            $table->tinyInteger('is_shifts')->default(0);
            $table->decimal('latitude',11,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->mediumText('polygon')->nullable();
            $table->foreignId('parent_id')
                ->nullable()
                ->references('id')
                ->on('branches');
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('share_client')->default(0);
            $table->tinyInteger('share_service')->default(0);
            $table->tinyInteger('share_paper')->default(0);
            $table->tinyInteger('share_shift')->default(0);
            $table->tinyInteger('share_manager')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
