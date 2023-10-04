<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->nullable();
            $table->string('number')->nullable();
            $table->date('date')->nullable();
            $table->string('second_party')->nullable();
            $table->longText('details')->nullable();
            $table->longText('commitments')->nullable();
            $table->longText('assigned_works')->nullable();
            $table->longText('definition')->nullable();
            $table->foreignIdFor(\Modules\Projects\Entities\ContractForm::class);
            $table->foreignIdFor(\App\Models\CMS\ProjectType::class)->nullable();
            $table->foreignIdFor(\App\Models\Client::class)->nullable();
            $table->foreignIdFor(\App\Models\Hr\Branch::class);
            $table->foreignIdFor(\App\Models\Hr\Management::class);
            $table->foreignIdFor(\App\Models\Status::class)->nullable();

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
        Schema::dropIfExists('contracts');
    }
}
