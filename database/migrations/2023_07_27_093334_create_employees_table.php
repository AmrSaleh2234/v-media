<?php

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Hr\Shift;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignIdFor(Country::class);
            $table->foreignIdFor(City::class);
            $table->text('address')->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Shift::class)->nullable();
            $table->tinyInteger('draft')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
