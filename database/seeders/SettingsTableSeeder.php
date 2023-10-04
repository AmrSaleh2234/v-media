<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'name',
                'value' => '{"ar":"مكتب أبعاد الرؤية","en":"Stephanie Joyner"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-17 13:38:20',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'slogan',
                'value' => '{"ar":"للاستشارات الهندسية","en":"Lee Lowery"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-17 13:38:20',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'social',
                'value' => '{"facebook":"https:\\/\\/www.facebook.com\\/VisionDimension","instagram":"https:\\/\\/www.instagram.com\\/visiondimension1\\/","snapchat":"https:\\/\\/t.snapchat.com\\/82B8ofP1"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-21 16:30:09',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'emails',
                'value' => '["info@vision-d2030.com"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-20 11:33:10',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'phones',
                'value' => '["+966538500542"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-20 11:33:10',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'whatsapp',
                'value' => '["+966538500542"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-21 05:29:56',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'address',
                'value' => '[{"address":"جدة -حي النهضة -شارع الصفا","link":"https:\\/\\/goo.gl\\/maps\\/pLHikAB8gDrf6gyA6"}]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-20 11:33:10',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'logo',
                'value' => '["uploads\\/website\\/0\\/logo\\/logo_1692624527757.png"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-17 13:38:20',
                'updated_at' => '2023-08-21 13:28:47',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'main_page_icon',
                'value' => '"partners"',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 06:59:36',
                'updated_at' => '2023-08-22 13:51:15',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'organization_chart',
                'value' => '["uploads\\/website\\/0\\/organization_chart\\/organization_chart_1692710214234.jpg"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 06:59:36',
                'updated_at' => '2023-08-22 13:16:54',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'about_page_icons',
                'value' => '"credences"',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-18 07:02:19',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'about_us',
                'value' => '{"ar":"ً مكتب أبعاد الرؤية للإستشارات الهندسية ملتزم مهنيا بتطبيق أفضل المعايير وأحدث التصاميم المعمارية والهندسية والبنيه\\nالتحتية بما تتوافق مع متطلبات الجهات ذات العلاقة بجوده عالية بأقل التكاليف وتقديم خدمات متميزة في الإشراف الميداني\\nالهندسي وإدرة المشاريع، فالمكتب يضم مجموعة متكاملة من المتخصصين ذوي الخبرة في هذا المجال.","en":"Is professionally committed to the best\\nAnd latest stage of architectural,\\nEngineering and structural designs\\nProducts related to the offers made Engineering\\nAnd project issuance,\\nThe office includes an integrated group\\nOf specialists with experience in this field.\\nWe give exceptional value on each\\nAnd every project we take on.\\nThis is done by getting the best from our team\\nAnd using the experience gained\\nFrom decades of fine tuning our processes.\\nIf it doesn’t represent value\\nThen it’s not Vision Dimensions.\\nThis is one of the main reasons\\nOur clients keep coming back"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-23 07:13:37',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'vision',
                'value' => '{"ar":"نقدم لعملائنا افضل الاستشارات والحلول الهندسية باستخدام اعلى معايير الجودة .","en":"To be recognized as a leading consulting firm in making Productivity And quality Improvement through people works."}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-21 16:02:07',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'goal',
                'value' => '{"ar":"خلق شركات ناجحة مع عملائنا للوصول لأهداف ـ مع تطور أعمالنا والرقي بها لكل ما هو جديد في الأسواق العالمية","en":"We are a global family that values diversity. We always do the right thing. With precision, pace and passion. We trust each other and have fun winning together. We own and shape our future. We create sustainable growth. For All."}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-21 16:02:07',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'slogan',
                'value' => '{"ar":"Ima Myers","en":"Noble Delacruz"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-18 07:02:19',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'about_page_image',
                'value' => '["uploads\\/website\\/0\\/about_page_image\\/about_page_image_1692634493580.jpg"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-21 16:14:53',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'projects',
                'value' => '{"0":{"ar":"مكاتب\\/ مشاريع ادارية","en":"Corporate\\/Office","num":"150"},"1":{"ar":"سكني وفلل","en":"Houseing","num":"750"},"2":{"ar":"تجاري ","en":"Commercial","num":"670"},"3":{"ar":"مباني صناعية","en":"industrial buildings","num":"375"},"4":{"ar":"بنيه تحتية ومخططات","en":"Infrastructure","num":"20"},"5":{"ar":"مبانى مرتفعة","en":"High rise buildings","num":"20"},"6":{"ar":"ضبط ومراقبه الجودة","en":"Quality Control Project","num":"112"},"7":{"ar":"تخطيط حضرى واقليمي","en":"Master Planning","num":"5"},"8":{"ar":"طبى ","en":"Aviation - Medical","num":"9"},"9":{"ar":"الاشراف ","en":"Supervision Project","num":"115"},"12":{"ar":"اعمال الامن والسلامة ","en":"Safety","num":"205"}}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-21 16:12:29',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'files',
                'value' => '["uploads\\/website\\/0\\/about-files\\/about-files_1692342139562.png"]',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-18 07:02:19',
                'updated_at' => '2023-08-18 07:02:19',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'group' => 'setting',
                'type' => 'shift_start',
                'key' => 'shift_start',
                'value' => '"30"',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-20 08:57:51',
                'updated_at' => '2023-08-20 08:57:51',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'group' => 'setting',
                'type' => 'shift_end',
                'key' => 'shift_end',
                'value' => '"30"',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-20 08:57:51',
                'updated_at' => '2023-08-20 08:57:51',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'apps',
                'value' => '{"app_store_link":"https:\\/\\/www.apple.com\\/store","play_store_link":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=com.corptia.visiondimensions&hl=en&gl=US"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-20 09:43:15',
                'updated_at' => '2023-08-22 09:59:06',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'main_description',
                'value' => '{"ar":"تغير بيانات النص في الصفحة الرئيسية","en":"At recusandae Modi "}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-20 11:16:17',
                'updated_at' => '2023-08-22 13:10:36',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'group' => 'about_us',
                'type' => 'website',
                'key' => 'about_slogan',
                'value' => '{"ar":"خلق علاقة ناجحة ومستدامة مع عملائنا بتقديم كل ما هو مميز وفريد ، وذلك لتجسيد رسالتنا كرواد في مجال تقديم خدمات الاستشارات الهندسية","en":"To exceed our customers’ expectations with innovative and bespoke Assurance, Testing, Inspection and Certification services for their operations Globally From its inception, VD Consultants is committed to Helping client’s improve quality and productivity."}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-20 14:02:44',
                'updated_at' => '2023-08-21 16:04:55',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'group' => 'setting',
                'type' => 'website',
                'key' => 'footer',
                'value' => '{"ar":"ابعاد  الرؤية ابدعنا فتميزنا ","en":"Dimensions of vision We excelled and distinguished us"}',
                'locale' => 'en',
                'autoload' => 0,
                'parent_id' => NULL,
                'created_at' => '2023-08-22 11:10:33',
                'updated_at' => '2023-08-22 16:24:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}