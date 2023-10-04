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
        Schema::create('company_project_service', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CMS\CompanyProject::class);
            $table->foreignIdFor(\App\Models\CMS\Service::class);
            $table->json('zone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_project_service');
    }
};
