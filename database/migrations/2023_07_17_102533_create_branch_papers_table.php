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
        Schema::create('branch_papers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\officialPaper::class)->nullable();
            $table->string('attachment')->nullable();
            $table->string('notification_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Hr\Branch::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_papers');
    }
};
