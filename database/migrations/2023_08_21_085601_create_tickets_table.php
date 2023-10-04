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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('has_ticket');
            $table->string('type');
            $table->string('title');
            $table->json('data');
            $table->foreignIdFor(\App\Models\Status::class)->nullable();
            $table->tinyInteger('priority')->nullable();
            $table->text('note');
            $table->text('response')->nullable();
            $table->boolean('resolved')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
