<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('news')->delete();
        
        \DB::table('news')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '{"ar": "فتح باب التوظيف", "en": "Zenaida Dorsey"}',
                'content' => '{"ar": "لد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.\\nومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.", "en": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volup"}',
                'image' => 'uploads/news/1/image/image_1692788306475.jpg',
                'category_id' => 5,
                'end_at' => '2024-11-14 11:15:00',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-23 10:58:26',
                'updated_at' => '2023-08-23 10:58:26',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '{"ar": "Charissa Byers", "en": "Maisie Gregory"}',
                'content' => '{"ar": "لد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.\\nومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.", "en": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volup"}',
                'image' => 'uploads/news/2/image/image_1692788352407.jpg',
                'category_id' => 5,
                'end_at' => '2024-10-16 13:08:00',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-23 10:59:12',
                'updated_at' => '2023-08-23 10:59:12',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => '{"ar": "فتح باب التقديم لتدريب هندسة الميكانيكا", "en": "Beatrice Clark"}',
                'content' => '{"ar": "لد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.\\nومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.", "en": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volup"}',
                'image' => 'uploads/news/3/image/image_1692788640607.jpg',
                'category_id' => 5,
                'end_at' => '2025-08-05 04:13:00',
                'app' => 0,
                'website' => 1,
                'created_at' => '2023-08-23 11:04:00',
                'updated_at' => '2023-08-23 11:04:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}