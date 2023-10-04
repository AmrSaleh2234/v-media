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
        Schema::create('company_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CMS\ProjectType::class);
            $table->json('name');
            $table->json('title');
            $table->string('main_image')->nullable();
            $table->json('description')->nullable();
            $table->json('details')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('app')->default(0);
            $table->boolean('website')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_projects');
    }
};
