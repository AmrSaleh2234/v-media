<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services')->delete();
        
        \DB::table('services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar": "إسم الخدمة عربي", "en": "Wyoming Richardson"}',
                'description' => '{"ar": "وصف الخدمة عربي", "en": "Fuga Expedita labor"}',
                'details' => NULL,
                'image' => 'uploads/services/1/image/image_1692523339452.jpg',
                'link' => 'Autem totam dolorem ',
                'icon' => 'uploads/services/1/icon/icon_1692279643902.png',
                'type' => NULL,
                'order_id' => '76',
                'category_id' => 1,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-17 13:40:43',
                'updated_at' => '2023-08-22 17:35:43',
                'deleted_at' => '2023-08-22 17:35:43',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar": "إسم الخدمة عربي", "en": "Adara Skinner"}',
                'description' => '{"ar": "وصف الخدمة عربي", "en": "Aliquid tempore vol"}',
                'details' => NULL,
                'image' => 'uploads/services/2/image/image_1692514571132.jpg',
                'link' => 'Beatae eum amet qua',
                'icon' => 'uploads/services/2/icon/icon_1692279740770.png',
                'type' => NULL,
                'order_id' => '69',
                'category_id' => 1,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-17 13:42:20',
                'updated_at' => '2023-08-22 17:35:40',
                'deleted_at' => '2023-08-22 17:35:40',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar": "إسم الخدمة عربي 11", "en": "Felix Kline"}',
                'description' => '{"ar": "وصف الخدمة عربي", "en": "Explicabo Reprehend"}',
                'details' => NULL,
                'image' => 'uploads/services/3/image/image_1692514554180.jpg',
                'link' => 'Possimus consequunt',
                'icon' => 'uploads/services/3/icon/icon_1692509031867.png',
                'type' => NULL,
                'order_id' => '19',
                'category_id' => 1,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-20 05:23:51',
                'updated_at' => '2023-08-22 17:35:35',
                'deleted_at' => '2023-08-22 17:35:35',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"ar": "خدمات التصميم للمبانى ", "en": "Building design services"}',
                'description' => '{"ar": "نقوم بتصميم المشاريع السكنية والتجارية بواسطة فريق من المهندسين المتخصصين بناءً على متطلبات العميل، بدايةً من المخطط الأساسي وصولاً إلى الهيكل النهائي المفروش بالكامل", "en": "Minima architecto es"}',
                'details' => NULL,
                'image' => 'uploads/services/4/image/image_1692729571803.jpg',
                'link' => 'Dolore maiores et vo',
                'icon' => 'uploads/services/4/icon/icon_1692528689340.png',
                'type' => NULL,
                'order_id' => '43',
                'category_id' => 3,
                'is_featured' => 1,
                'app' => 1,
                'website' => 1,
                'created_at' => '2023-08-20 10:51:29',
                'updated_at' => '2023-08-22 18:42:48',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"ar": "الاستشارات والدرسات البيئية ", "en": "Environmental consulting and studies"}',
                'description' => '{"ar": "يتمتع المكتب بالكادر الفني المؤهل والخبرة الكافية لاعداد دراسات تقييم الأثر البيئي ودراسات التدقيق البيئي في جميع المجالات سواءا صناعية , او تنموية , او تجارية والوقوف على التاثيرات البيئية المترتبة عليها للحصول على اعلى قدر من الكفاءة للمشاريع بما يتوافق مع النظام العام للمركز الوطني للرقابة على الالتزام البيئي ولائحته التنفيذية", "en": "The office has qualified technical staff and sufficient experience to prepare environmental impact assessment studies and environmental audit studies in all fields, whether industrial, developmental, or commercial, and to find out the environmental impacts resulting from them to obtain the highest level of efficiency for projects in accordance with the general system of the National Center for Environmental Compliance Control and its executive regulations"}',
                'details' => NULL,
                'image' => 'uploads/services/5/image/image_1692730346176.png',
                'link' => 'Environmental consulting and studies',
                'icon' => 'uploads/services/5/icon/icon_1692730346456.png',
                'type' => NULL,
                'order_id' => '2',
                'category_id' => 4,
                'is_featured' => 1,
                'app' => 1,
                'website' => 1,
                'created_at' => '2023-08-22 18:52:26',
                'updated_at' => '2023-08-22 18:52:26',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}