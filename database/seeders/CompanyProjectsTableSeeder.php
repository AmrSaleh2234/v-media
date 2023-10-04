<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company_projects')->delete();
        
        \DB::table('company_projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_type_id' => 1,
                'name' => '{"ar": "إسم المشروع عربي ", "en": "Rigel Rasmussen"}',
                'title' => '{"ar": "عنوان المشروع عربي", "en": "Xyla Meyers"}',
                'main_image' => 'uploads/company-projects/1/main_image/main_image_1692624746997.png',
                'description' => '{"ar": "وصف المشروع عربي", "en": "Lorem irure voluptat"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 0,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-17 13:46:11',
                'updated_at' => '2023-08-22 16:07:45',
                'deleted_at' => '2023-08-22 16:07:45',
            ),
            1 => 
            array (
                'id' => 2,
                'project_type_id' => 2,
                'name' => '{"ar": "بحث عن طريق الاسم", "en": "Akeem Odonnell"}',
                'title' => '{"ar": "عنوان المشروع عربي", "en": "Britanney Castro"}',
                'main_image' => 'uploads/company-projects/2/main_image/main_image_1692528362246.jpg',
                'description' => '{"ar": "وصف المشروع عربي", "en": "Aliquam voluptas ab "}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 0,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-20 10:46:02',
                'updated_at' => '2023-08-21 17:11:10',
                'deleted_at' => '2023-08-21 17:11:10',
            ),
            2 => 
            array (
                'id' => 3,
                'project_type_id' => 1,
                'name' => '{"ar": "إسم المشروع عربي ", "en": "Cade Sawyer"}',
                'title' => '{"ar": "عنوان المشروع عربي", "en": "Skyler Curtis"}',
                'main_image' => 'uploads/company-projects/3/main_image/main_image_1692621970414.jpg',
                'description' => '{"ar": "ا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.\\nومن هنا وجب على المصمم أن يضع نصوص", "en": "Est maiores voluptatk"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-20 10:47:33',
                'updated_at' => '2023-08-22 16:10:07',
                'deleted_at' => '2023-08-22 16:10:07',
            ),
            3 => 
            array (
                'id' => 4,
                'project_type_id' => 2,
                'name' => '{"ar": "إسم المشروع عربي", "en": "Sasha Church"}',
                'title' => '{"ar": "عنوان المشروع عربي", "en": "Rhiannon Decker"}',
                'main_image' => 'uploads/company-projects/4/main_image/main_image_1692624818334.png',
                'description' => '{"ar": "وصف المشروع عربي", "en": "In non aut obcaecati"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 0,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-20 10:52:22',
                'updated_at' => '2023-08-22 16:10:03',
                'deleted_at' => '2023-08-22 16:10:03',
            ),
            4 => 
            array (
                'id' => 5,
                'project_type_id' => 4,
                'name' => '{"ar": "Lyle Vasquez", "en": "Roary Romero"}',
                'title' => '{"ar": "مشروع بناء بيت", "en": "Briar Fischer"}',
                'main_image' => 'uploads/company-projects/5/main_image/main_image_1692704253851.jpg',
                'description' => '{"ar": "Error accusantium ut", "en": "Reiciendis eiusmod p"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 11:37:33',
                'updated_at' => '2023-08-22 16:09:59',
                'deleted_at' => '2023-08-22 16:09:59',
            ),
            5 => 
            array (
                'id' => 6,
                'project_type_id' => 4,
                'name' => '{"ar": "Lyle Vasquez", "en": "Roary Romero"}',
                'title' => '{"ar": "مشروع بناء بيت", "en": "Briar Fischer"}',
                'main_image' => 'uploads/company-projects/6/main_image/main_image_1692704254135.jpg',
                'description' => '{"ar": "Error accusantium ut", "en": "Reiciendis eiusmod p"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 11:37:34',
                'updated_at' => '2023-08-22 16:10:20',
                'deleted_at' => '2023-08-22 16:10:20',
            ),
            6 => 
            array (
                'id' => 7,
                'project_type_id' => 2,
                'name' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'title' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'main_image' => 'uploads/company-projects/7/main_image/main_image_1692704492499.jpg',
                'description' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 0,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 11:41:32',
                'updated_at' => '2023-08-22 16:10:47',
                'deleted_at' => '2023-08-22 16:10:47',
            ),
            7 => 
            array (
                'id' => 8,
                'project_type_id' => 2,
                'name' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'title' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'main_image' => 'uploads/company-projects/8/main_image/main_image_1692704523192.jpg',
                'description' => '{"ar": "العديد من النصوص الأخرى إضافة إ", "en": "العديد من النصوص الأخرى إضافة إ"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 0,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 11:42:03',
                'updated_at' => '2023-08-22 16:08:55',
                'deleted_at' => '2023-08-22 16:08:55',
            ),
            8 => 
            array (
                'id' => 9,
                'project_type_id' => 4,
                'name' => '{"ar": "Bernard Mccormick", "en": "Xaviera Landry"}',
                'title' => '{"ar": "Remedios Warner", "en": "Cruz Bowen"}',
                'main_image' => 'uploads/company-projects/9/main_image/main_image_1692705252359.jpg',
                'description' => '{"ar": "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.\\nومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.", "en": "Dolorem maiores susc"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 1,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 11:54:12',
                'updated_at' => '2023-08-22 16:10:44',
                'deleted_at' => '2023-08-22 16:10:44',
            ),
            9 => 
            array (
                'id' => 10,
                'project_type_id' => 4,
                'name' => '{"ar": "Hadley Cleveland", "en": "Kibo Pratt"}',
                'title' => '{"ar": "Gay Hickman", "en": "Castor Herman"}',
                'main_image' => 'uploads/company-projects/10/main_image/main_image_1692705329619.jpg',
                'description' => '{"ar": "Natus enim incididun", "en": "Eius eum reiciendis "}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 0,
                'app' => 0,
                'website' => 0,
                'created_at' => '2023-08-22 11:55:29',
                'updated_at' => '2023-08-22 16:09:32',
                'deleted_at' => '2023-08-22 16:09:32',
            ),
            10 => 
            array (
                'id' => 11,
                'project_type_id' => 6,
                'name' => '{"ar": "فيلا سكنية بمساحه 1200م2", "en": "Residential villa in rabgh"}',
                'title' => '{"ar": "فيلا سكنية برابغ", "en": "Residential villa in rabgh"}',
                'main_image' => 'uploads/company-projects/11/main_image/main_image_1692725027206.jpg',
                'description' => '{"ar": "تصميم معمارى وانشائي لمساحه 1200م2 بدورين تحتوى على مسبح وجميع الخدمات ", "en": "Architectural and structural design for an area of ​​1200 square meters, in two floors, including a swimming pool and all services"}',
                'details' => NULL,
                'link' => NULL,
                'is_featured' => 1,
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-22 17:23:47',
                'updated_at' => '2023-08-22 17:49:23',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}