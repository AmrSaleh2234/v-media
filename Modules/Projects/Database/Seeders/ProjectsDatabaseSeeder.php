<?php

namespace Modules\Projects\Database\Seeders;

use App\Models\Message;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\Task;

class ProjectsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();
        $statuses = [ 'valid' , 'in-progress', 'off' , 'over'];

        foreach ($statuses as $status){
            Status::create(['name' => $status , 'type' => 'projectItem']);
        }
//        Message::factory(500)->create();

        Status::create(['name' => 'ساري' , 'type' => 'contract' , 'color' => 'ok']);
        Status::create(['name' => 'متاخر' , 'type' => 'contract' , 'color' => 'late']);
        Status::create(['name' => 'متوقف' , 'type' => 'contract' , 'color' => 'stopped']);
        Status::create(['name' => 'منتهي' , 'type' => 'contract' , 'color' => 'finished']);

        Project::factory(20)->has(Task::factory(3),'tasks')->has(Message::factory(10),'messages')->create();

        $users = User::take(12)->get();
        $tasks = Task::take(60)->get();
        $tasks->each(function($task) use ($users) {
            $task->users()->sync($users->random(3));
        });
    }
}
