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
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('responsible')->nullable();
            $table->dateTime('time_from')->nullable();
            $table->dateTime('time_to')->nullable();
            $table->decimal('latitude',11,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->string('address')->nullable();
            $table->string('from')->nullable();
            $table->text('response')->nullable();
            $table->foreignIdFor(App\Models\Employee\Employee::class);
            $table->foreignIdFor(\App\Models\Status::class)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_requests');
    }
};
