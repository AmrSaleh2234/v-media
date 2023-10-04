<?php

use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\Task;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->default(0)->comment('0 for main, 1 for sub');
            $table->double('amount')->default(0);
            $table->integer('period')->default(0);
            $table->dateTime('start_date');
            $table->smallInteger('duration');
            $table->dateTime('actual_date')->nullable();
            $table->foreignIdFor(Project::class);
            $table->foreignIdFor(City::class)->nullable();
            $table->foreignId('parent_id')->nullable()->references('id')->on('tasks');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);
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
        Schema::dropIfExists('tasks');
    }
}
