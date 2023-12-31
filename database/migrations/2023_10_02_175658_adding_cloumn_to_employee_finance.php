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
        Schema::table('employee_finances', function (Blueprint $table) {
            $table->double('minute_value')->after('hourly_value')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_finances', function (Blueprint $table) {
            $table->dropColumn('minute_value');
        });
    }
};
