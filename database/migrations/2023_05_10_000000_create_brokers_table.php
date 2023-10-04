<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Hr\Branch::class)->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('card_id')->nullable();
            $table->mediumText('card_image')->nullable();
            $table->foreignIdFor(\App\Models\Status::class)->nullable();
            $table->tinyInteger('accounting_method')->default(1);
            $table->string('percentage')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->mediumText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brokers');
    }
}
