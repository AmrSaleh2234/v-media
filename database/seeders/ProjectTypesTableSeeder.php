<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('project_types')->delete();
        
        \DB::table('project_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar": "عقد رخص", "en": "license contract"}',
                'group' => NULL,
                'color' => NULL,
                'deleted_at' => '2023-08-22 16:24:46',
                'created_at' => '2023-08-17 13:21:31',
                'updated_at' => '2023-08-22 16:24:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar": "رخصة بناء", "en": "Building license "}',
                'group' => NULL,
                'color' => NULL,
                'deleted_at' => '2023-08-22 16:10:55',
                'created_at' => '2023-08-17 13:21:31',
                'updated_at' => '2023-08-22 16:10:55',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar": "عرض سعر", "en": "offer price"}',
                'group' => NULL,
                'color' => NULL,
                'deleted_at' => '2023-08-22 16:08:18',
                'created_at' => '2023-08-17 13:21:31',
                'updated_at' => '2023-08-22 16:08:18',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"ar": "مشروع جديد", "en": "q"}',
                'group' => '12',
                'color' => NULL,
                'deleted_at' => '2023-08-22 16:10:53',
                'created_at' => '2023-08-22 09:28:30',
                'updated_at' => '2023-08-22 16:10:53',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"ar": "sac", "en": "scasc"}',
                'group' => 'sac',
                'color' => NULL,
                'deleted_at' => '2023-08-22 16:24:51',
                'created_at' => '2023-08-22 16:24:39',
                'updated_at' => '2023-08-22 16:24:51',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '{"ar": "مبانى سكنية ", "en": "Residential buildings"}',
                'group' => '1',
                'color' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2023-08-22 17:03:25',
                'updated_at' => '2023-08-22 17:03:25',
            ),
        ));
        
        
    }
}