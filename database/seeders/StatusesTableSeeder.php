<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('statuses')->delete();
        
        \DB::table('statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'accepted',
                'type' => 'requests',
                'color' => 'active',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:31',
                'updated_at' => '2023-08-17 13:21:31',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'denied',
                'type' => 'requests',
                'color' => 'stopped',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:31',
                'updated_at' => '2023-08-17 13:21:31',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'pending',
                'type' => 'requests',
                'color' => 'late',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:31',
                'updated_at' => '2023-08-17 13:21:31',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'valid',
                'type' => 'projectItem',
                'color' => NULL,
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'in-progress',
                'type' => 'projectItem',
                'color' => NULL,
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'off',
                'type' => 'projectItem',
                'color' => NULL,
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'over',
                'type' => 'projectItem',
                'color' => NULL,
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'ساري',
                'type' => 'contract',
                'color' => 'ok',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'متاخر',
                'type' => 'contract',
                'color' => 'late',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'متوقف',
                'type' => 'contract',
                'color' => 'stopped',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'منتهي',
                'type' => 'contract',
                'color' => 'finished',
                'active' => 1,
                'created_at' => '2023-08-17 13:21:32',
                'updated_at' => '2023-08-17 13:21:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}