<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar": "إسم الفئة عربي", "en": "eeeeeeeee"}',
                'type' => 'services',
                'parent_id' => NULL,
                'active' => 0,
                'created_at' => '2023-08-17 13:40:10',
                'updated_at' => '2023-08-17 13:40:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar": "Desirae Mcclain", "en": "Jerry Alvarado"}',
                'type' => 'services',
                'parent_id' => NULL,
                'active' => 0,
                'created_at' => '2023-08-20 14:36:11',
                'updated_at' => '2023-08-20 14:36:11',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar": "الرخص", "en": "premit"}',
                'type' => 'services',
                'parent_id' => NULL,
                'active' => 0,
                'created_at' => '2023-08-22 17:22:40',
                'updated_at' => '2023-08-22 17:22:40',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"ar": "الدرسات والتصاميم ", "en": "Studies and designs"}',
                'type' => 'services',
                'parent_id' => NULL,
                'active' => 0,
                'created_at' => '2023-08-22 18:47:01',
                'updated_at' => '2023-08-22 18:47:01',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"ar": "اخبار الشركة", "en": "Company News"}',
                'type' => 'news',
                'parent_id' => NULL,
                'active' => 0,
                'created_at' => '2023-08-23 10:57:55',
                'updated_at' => '2023-08-23 10:57:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}