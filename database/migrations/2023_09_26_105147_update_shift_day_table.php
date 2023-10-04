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
        Schema::table('shift_days', function (Blueprint $table) {
            $table->string('early_start_in')->nullable()->after('start_in');
            $table->string('late_start_in')->nullable()->after('early_start_in');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shift_days', function (Blueprint $table) {
            $table->dropColumn('early_start_in');
            $table->dropColumn('late_start_in');
        });
    }
};
