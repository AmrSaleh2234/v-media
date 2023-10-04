<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('members')->delete();
        
        \DB::table('members')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar": "م/ محسن القرني", "en": "Eng. Mohsen Al-Qarni"}',
                'job_title' => '{"ar": "المدير العام", "en": "General Director"}',
                'image' => 'uploads/news/1/image/image_1692636901368.jpg',
            'description' => '{"ar": "- بكالريوس الهندسة الكهربائية جامعة الملك عبد العزيز \\n- عضوية الهيئه السعودية للمهندسين (مستشار ) \\n-معتمد من الشركة السعودية للكهرباء كااستشاري ورئيس قسم بالشركة السعوديه للكهرباء لمده 16 عام \\n-خبره بالمسارات المخدثة لفرز المخططات من الاسكان ومعتمد لدي برنامج البيع على الخارطه وافي \\n- معتمد مشرف عام على مشاريع تمديد الخطوط الرئيسيه لشركة المياه الوطنيه \\n- حاصل على شعار التميز والجودة من الشركة السعودية للكهرباء فى رفع جودة تنفيذ الاعمال على الطبيعة \\n", "en": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non"}',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 08:59:39',
                'updated_at' => '2023-08-21 16:55:01',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar": "م.محمد الغامدي", "en": "Eng.Mohammed Al-Ghamdi"}',
                'job_title' => '{"ar": "رئيس مجلس ادارة", "en": "chairman"}',
                'image' => 'uploads/news/2/image/image_1692635973864.jpg',
                'description' => '{"ar": "خريج كلية الهندسة من جامعة الملك عبد العزيز تخصص هندسة كهربائية .ابتدت مسيرته المهنية في الشركة السعودية للكهرباء ودامت لمدة 22 عام تقلد فيها مناصب عدة حتى أصبح مدير الإنشاءات ليكون جزء مميز وبارز في الشركة بإنجازات حققت المراكز الاولي عالميآ ووفر على ميزانية الشركة مليارات الريالات بخطط مدروسة واستراتيجيات ممتازة .\\n\\n\\n عضو فعال في تنفيذ العديد من الفعاليات والمؤتمرات والمعارض الخاصة في الشركة السعوديه للكهرباء . \\n\\n\\nعضوا في العديد من الهيئات والمنظمات محلية وعالمية. \\n\\nحضر لعدد هائل من الدورات المتخصصة في التطوير الإداري والفني البعض منها محلي والبعض عالمي  .\\n\\n\\nتفرغ  لإنشاء شركته الخاصة للاستشارات الهندسية وفي عام 2017 بدأ شغفه في مجال الإعلام ليكون اليوم عضو مؤسس في مجموعه عالم المحيطات التي تقدم خدمات عدة عن طريق شركاتها المتعددة وفي ظل النهضة التي تشهدها مملكتنا الحبيبة في عهد خادم الحرمين الشريفين حفظه الله والنظرة المستقبلية من خلال رؤية 2030 لسمو ولي العهد حفظه الله نحو الاعمار والترفيه والسياحة والإعلام وتقنية المعلومات والاهتمام بالبيئة للبلاد ومع التطور القياسي الذي شهدته المملكة العربية السعودية وايمانا منا بدورنا الذي تحتمه علينا وطنيتنا في القيام بالدور الذي يدفع عجلة التنمية فيها والانتقال نحو للعالمية,فقد أطلقنا شركة من الشركات الرائدة المخططة من مجالات عدة ومنذ أنشأناها ونحن في بحث علمي وعملي دائم لنمضي قدما نحو الأفضل والأكثر تميزا ونشارك في صناعة هذه النهضة من خلال خدماتنا المتخصصة والمتميزة في كافة الأنشطة والمجالات التي نعمل بها في جميع شركاتنا لنمتلك اليوم موقعا راسخا في السوق.", "en": "Ducimus et molestia"}',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-20 09:55:33',
                'updated_at' => '2023-08-21 16:56:12',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar": "م.سعد مشعل", "en": "Eng.Saad Mashal"}',
                'job_title' => '{"ar": "مدير عام المشاريع", "en": "Projects General Manager"}',
                'image' => 'uploads/news/3/image/image_1692637343179.jpg',
                'description' => '{"ar": "بكالريوس الهندسه المدنيه \\nعضويه نقابه المهندسين المصريه / الهيئة السعوديه للمهندسين \\nمعتمد من  امانه جدة / وزاره الاسكان \\nوزاره الصحه \\nالشركه السعوديه للكهرباء \\nشركه المياه الوطنيه \\nمدرب معتمد من جامعه القاهره للبرامج الهندسية \\nحاصل علي التميز من المعهد التقني لاداره  الجودة \\nحاصل علي دبلومه اداره المخاطر في المشاريع الهندسية", "en": "Projects General Manager\\n"}',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-21 17:02:23',
                'updated_at' => '2023-08-21 17:02:23',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"ar": "Stewart Sellers", "en": "Charde Zamora"}',
                'job_title' => '{"ar": "Boris Duncan", "en": "Susan Dillard"}',
                'image' => 'uploads/news/4/image/image_1692711286363.jpg',
                'description' => '{"ar": "Eveniet est quae om", "en": "Elit ex consequuntu"}',
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 13:34:46',
                'updated_at' => '2023-08-22 13:34:58',
                'deleted_at' => '2023-08-22 13:34:58',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"ar": "Timothy Fuller", "en": "Addison Baxter"}',
                'job_title' => '{"ar": "Keely Mcdonald", "en": "Gage Meyer"}',
                'image' => 'uploads/news/5/image/image_1692711356187.png',
                'description' => '{"ar": "Laborum Omnis rerum", "en": "Id esse doloremque "}',
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 13:35:56',
                'updated_at' => '2023-08-22 13:36:07',
                'deleted_at' => '2023-08-22 13:36:07',
            ),
        ));
        
        
    }
}