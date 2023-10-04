<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Modules\Projects\Entities\Contract::class);
            $table->double('amount')->default(0);
            $table->integer('period')->default(0);
            $table->string('end_date')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_payments');
    }
}
