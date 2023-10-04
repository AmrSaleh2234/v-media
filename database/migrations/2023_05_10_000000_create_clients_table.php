<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('from');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('otp')->nullable();
            $table->dateTime('otp_expire')->nullable();
            $table->string('lang')->default('ar');
            $table->rememberToken();

            $table->foreignIdFor(\App\Models\Hr\Branch::class)->nullable();
            $table->foreignIdFor(\App\Models\Broker::class)->nullable();
            $table->foreignIdFor(\App\Models\Status::class)->nullable();
            $table->foreignIdFor(\App\Models\ClientRequest::class)->nullable();

            $table->string('agent_name')->nullable();
            $table->string('register_number')->nullable();
            $table->string('register_image')->nullable();
            $table->string('letter_head')->nullable();
            $table->string('card_id')->nullable();
            $table->mediumText('card_image')->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('confirmed')->default(1);

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
        Schema::dropIfExists('clients');
    }
}
