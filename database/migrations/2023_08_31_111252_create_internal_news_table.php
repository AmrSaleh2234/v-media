<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Hr\Management;
use App\Models\Hr\Department;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internal_news', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title')->nullable(); // ar => en
            $table->foreignIdFor(Management::class);
            $table->foreignIdFor(Department::class);
            $table->string('attachment')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_news');
    }
};
