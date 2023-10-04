<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => 'يجب قبول الحقل :attribute',
    'active_url' => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before' => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date' => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_format' => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام ',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists' => 'الحقل :attribute لاغٍ',
    'file' => 'الـ :attribute يجب أن يكون من ملفا.',
    'filled' => 'الحقل :attribute إجباري',
    'image' => 'يجب أن يكون الحقل :attribute صورةً',
    'in' => 'الحقل :attribute لاغٍ',
    'in_array' => 'الحقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة',
    'json' => 'يجب أن يكون الحقل :attribute نصا من نوع JSON.',
    'max' => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array' => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min' => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array' => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in' => 'الحقل :attribute لاغٍ',
    'numeric' => 'يجب على الحقل :attribute أن يكون رقمًا',
    'present' => 'يجب تقديم الحقل :attribute',
    'regex' => 'صيغة الحقل :attribute .غير صحيحة',
    'required' => 'الحقل :attribute مطلوب.',
    'required_if' => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :values.',
    'required_unless' => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all' => 'الحقل :attribute إذا توفّر :values.',
    'required_without' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size' => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array' => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'string' => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',
    'unique_category_link_type' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'unique_post_link_type' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'unique_category_update_link_type' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'unique_post_update_link_type' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'with_out_spaces' => 'الحقل :attribute يجب ان يكون بلا مسافات',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'values' => [
        'company' => 'شركة',
        'individual' => 'فردى',
    ],

    'attributes' => [
        'name' => 'الاسم',
        'link' => 'الرابط',
        'type' => 'النوع',
        'username' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'first_name' => 'الاسم',
        'last_name' => 'اسم العائلة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'branch' => 'الفرع',
        'client' => 'العميل',
        'employee' => 'الموظف',
        'name_ar' => 'اﻹسم عربى',
        'employee_id' => 'الموظف',
        'client_id' => 'العميل',
        'branch_id' => 'الفرع',
        'city_id' => 'المدينة',
        'state_id' => 'المحافظة',
        'country_id' => 'الدولة',
        'address' => 'العنوان',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'اللقب',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',
        'attachment' => 'الملف المرفق',
        'image' => 'الصورة',
        'job_type' => 'نوع الوظيفة',
        'job_type_id' => 'نوع الوظيفة',
        'job_name' => 'المسمى الوظيفى',
        'job_name_id' => 'المسمى الوظيفى',
        'job_grade' => 'الدرجة الوظيفية',
        'job_grade_id' => 'الدرجة الوظيفية',
        'card_id' => 'رقم الهوية',
        'card_image' => 'صورة الهوية',
        'company_name' => 'إسم الشركة',
        'register_number' => 'رقم السجل التجارى',
        'register_image' => 'صورة السجل التجارى',
        'agent_name' => 'إسم الوكيل',
        'management_id' => 'الإدارة',
        'department_id' => 'القسم',
        'company' => 'شركة',
        'individual' => 'فردى',
        'letter_head' => 'عنوان المراسلات',
        'main_image' => 'الصورة الرئيسية',
        'yesterday' => 'البارحة',
        'today' => 'اليوم',
        'tomorrow' => 'غداً',
        'end_at' => "تاريخ الإنتهاء",
        'status_id' => 'الحالة',
        'published_at' => 'تاريخ النشر',
        'now' => 'الآن',
        'title_en' => 'العنوان الإنجليزية',
        'setting.organization_chart.0' => 'الملف التعريفى للشركة',
        'setting.files.*.name' => 'إسم الملف',
        'setting.about_slogan.en' => 'شعار الشركة الانجليزية',
//        'setting.' => [
//            'organization_chart.*' =>  'الملف التعريفى للشركة',
//            'files.*.name' => 'إسم الملف',
//        ],

        'employee' => [
            'phone' => 'رقم الهاتف',
            'relative_type' => 'صلة القرابة',
            'address' => 'عنوان الموظف',
            'country_id' => 'دولة الموظف',
            'city_id' => 'مدينة الموظف',
        ],
        'info' => [

        ],
        'relative' => [
            'relative.full_name' => 'إسم القريب',
            'relative.phone' => 'رقم جوال القريب',
            'relative_Type' => 'صلة القرابة'
        ],
        'motherAddress' => [
            'country_id' => 'الدولة الأم',
            'city_id' => 'المدينة الأم',
            'address' => 'العنون فى البلد الأم',
        ],


    ],

];
