<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('number');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('done_at')->nullable();
            $table->string('type');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);
            $table->foreignIdFor(\Modules\Projects\Entities\Contract::class)->nullable();
            $table->foreignIdFor(\App\Models\CMS\ProjectType::class)->nullable();

            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->foreignIdFor(\App\Models\Client::class);
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
        Schema::dropIfExists('projects');
    }
}
