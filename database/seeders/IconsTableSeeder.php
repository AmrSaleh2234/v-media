<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IconsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('icons')->delete();
        
        \DB::table('icons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar": "Chester Gilmore", "en": "Acton Christian"}',
                'logo' => 'uploads/icons/1/logo/logo_1692523147524.png',
                'link' => 'Voluptatem esse et ',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:19:07',
                'updated_at' => '2023-08-20 09:19:54',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar": "Aquila Weaver", "en": "Vera Wolf"}',
                'logo' => 'uploads/icons/2/logo/logo_1692523562555.png',
                'link' => 'Quia quidem mollitia',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:19:22',
                'updated_at' => '2023-08-20 09:26:02',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar": "Myra Mcmillan", "en": "Jaime Hardy"}',
                'logo' => 'uploads/icons/3/logo/logo_1692523173472.png',
                'link' => 'A commodi architecto',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:19:33',
                'updated_at' => '2023-08-20 09:20:07',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"ar": "Andrew Blanchard", "en": "Chaim Ferguson"}',
                'logo' => 'uploads/icons/4/logo/logo_1692595634585.png',
                'link' => 'Consequuntur tempor ',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:19:44',
                'updated_at' => '2023-08-21 05:27:14',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"ar": "Bree Robinson", "en": "Brendan Dillard"}',
                'logo' => 'uploads/icons/5/logo/logo_1692523216187.png',
                'link' => 'Atque quia quasi eli',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:20:16',
                'updated_at' => '2023-08-20 09:20:16',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '{"ar": "Ina Moody", "en": "Slade Cohen"}',
                'logo' => 'uploads/icons/6/logo/logo_1692523550719.png',
                'link' => 'Duis voluptas lorem ',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:20:33',
                'updated_at' => '2023-08-20 09:25:50',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '{"ar": "Nehru Vega", "en": "Eliana Manning"}',
                'logo' => 'uploads/icons/7/logo/logo_1692523539224.png',
                'link' => 'Pariatur Dolor id r',
                'type' => 'partners',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:20:48',
                'updated_at' => '2023-08-20 09:25:39',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '{"ar": "Wylie Salas", "en": "Noble Witt"}',
                'logo' => 'uploads/icons/8/logo/logo_1692523578174.png',
                'link' => 'Sint qui et earum il',
                'type' => 'certificates',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:26:18',
                'updated_at' => '2023-08-20 09:26:18',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}