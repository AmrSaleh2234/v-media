<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyProjectServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company_project_service')->delete();
        
        \DB::table('company_project_service')->insert(array (
            0 => 
            array (
                'id' => 18,
                'company_project_id' => 2,
                'service_id' => 2,
                'zone' => '{"ar": "Alfonso Bolton", "en": "Valentine Pate"}',
                'created_at' => '2023-08-21 17:11:04',
                'updated_at' => '2023-08-21 17:11:04',
            ),
            1 => 
            array (
                'id' => 30,
                'company_project_id' => 2,
                'service_id' => 1,
                'zone' => '{"ar": "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة. هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة.هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة. هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة.هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة. هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة.", "en": "Wayne Ramirez"}',
                'created_at' => '2023-08-22 16:07:40',
                'updated_at' => '2023-08-22 16:07:40',
            ),
            2 => 
            array (
                'id' => 32,
                'company_project_id' => 3,
                'service_id' => 8,
                'zone' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'created_at' => '2023-08-22 16:08:49',
                'updated_at' => '2023-08-22 16:08:49',
            ),
            3 => 
            array (
                'id' => 33,
                'company_project_id' => 4,
                'service_id' => 8,
                'zone' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'created_at' => '2023-08-22 16:08:49',
                'updated_at' => '2023-08-22 16:08:49',
            ),
            4 => 
            array (
                'id' => 34,
                'company_project_id' => 2,
                'service_id' => 10,
                'zone' => '{"ar": "Christine Booker", "en": "Sarah Slater"}',
                'created_at' => '2023-08-22 16:09:27',
                'updated_at' => '2023-08-22 16:09:27',
            ),
            5 => 
            array (
                'id' => 35,
                'company_project_id' => 2,
                'service_id' => 10,
                'zone' => '{"ar": "Katelyn Richardson", "en": "Pandora Gardner"}',
                'created_at' => '2023-08-22 16:09:27',
                'updated_at' => '2023-08-22 16:09:27',
            ),
            6 => 
            array (
                'id' => 36,
                'company_project_id' => 4,
                'service_id' => 5,
                'zone' => '{"ar": "Isaiah Weiss", "en": "Ella Hoover"}',
                'created_at' => '2023-08-22 16:09:38',
                'updated_at' => '2023-08-22 16:09:38',
            ),
            7 => 
            array (
                'id' => 37,
                'company_project_id' => 4,
                'service_id' => 6,
                'zone' => '{"ar": "Isaiah Weiss", "en": "Ella Hoover"}',
                'created_at' => '2023-08-22 16:09:43',
                'updated_at' => '2023-08-22 16:09:43',
            ),
            8 => 
            array (
                'id' => 38,
                'company_project_id' => 1,
                'service_id' => 4,
                'zone' => '{"ar": "Eugenia Emerson", "en": "Quincy Sutton"}',
                'created_at' => '2023-08-22 16:09:46',
                'updated_at' => '2023-08-22 16:09:46',
            ),
            9 => 
            array (
                'id' => 39,
                'company_project_id' => 1,
                'service_id' => 3,
                'zone' => '{"ar": "Lydia Harris", "en": "Gay Carson"}',
                'created_at' => '2023-08-22 16:09:51',
                'updated_at' => '2023-08-22 16:09:51',
            ),
            10 => 
            array (
                'id' => 40,
                'company_project_id' => 4,
                'service_id' => 9,
                'zone' => '{"ar": "Amos Holland", "en": "Clarke Reynolds"}',
                'created_at' => '2023-08-22 16:10:31',
                'updated_at' => '2023-08-22 16:10:31',
            ),
            11 => 
            array (
                'id' => 41,
                'company_project_id' => 1,
                'service_id' => 7,
                'zone' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'created_at' => '2023-08-22 16:10:38',
                'updated_at' => '2023-08-22 16:10:38',
            ),
            12 => 
            array (
                'id' => 46,
                'company_project_id' => 4,
                'service_id' => 11,
                'zone' => '{"ar": "تصميم معماري لمنزل مودرن ، اعتمد على التوازن والهدو في التصميم المعماري الخارجي وتصميم المشاهد الطبيعية، مما أعطى فخامة وجاذبية وراحة نفسية. نلاحظ في التصميم اعتماد الزجاج كعنصر رئيسي، مع استخدام التوازن غير المتماثل في التصميم.", "en": "An architectural design for a modern house, based on balance and calmness in the exterior architectural design and landscape design, which gave luxury, attractiveness, and psychological comfort. In the design, we notice the adoption of glass as a main element, with the use of asymmetrical balance in the design."}',
                'created_at' => '2023-08-22 17:49:23',
                'updated_at' => '2023-08-22 17:49:23',
            ),
        ));
        
        
    }
}