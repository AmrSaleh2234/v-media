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
        Schema::create('client_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('from');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('register_number')->nullable();
            $table->string('register_image')->nullable();
            $table->string('letter_head')->nullable();
            $table->string('card_id')->nullable();
            $table->mediumText('card_image')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('responsible')->nullable()->references('id')->on('users');
            $table->foreignIdFor(\App\Models\Hr\Branch::class)->nullable();
            $table->foreignIdFor(\App\Models\Status::class);
            $table->mediumText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_requests');
    }
};
