<?php

use App\Models\Employee\Employee;
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
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->string('personal_photo')->nullable();
            $table->string('id_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('national_photo')->nullable();
            $table->string('border_no')->nullable();
            $table->string('border_photo')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_infos');
    }
};
