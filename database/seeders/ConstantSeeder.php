<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CMS\ProjectType;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Hr\Branch;
use App\Models\Hr\Department;
use App\Models\Hr\Grade;
use App\Models\Hr\Management;
use App\Models\Hr\Shift;
use App\Models\Hr\University;
use App\Models\Setting;
use App\Models\State;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ConstantSeeder extends Seeder
{
    public function addModelsCrud($models)
    {
        foreach ($models as $model) {
            $permission_methods = [
                "{$model}.index" => "view" ,
                "{$model}.create,{$model}.store" => "create",
                "{$model}.edit,{$model}.update" => "edit",
                "{$model}.show" => "show",
                "{$model}.delete" => "delete",
            ];
            foreach ($permission_methods as  $name => $method) {
                Permission::Create([
                    'name' => $name,
                    'guard_name' =>"web",
                ]);
            }
        }
    }

    public function addModelsNotCrud()
    {
        Permission::Create([
            'name' => 'translations.index' ,
            'guard_name' =>"web",
        ]);

        Permission::Create([
            'name' => 'tables.index' ,
            'guard_name' =>"web",
        ]);

        Permission::Create([
            'name' => 'images.index' ,
            'guard_name' =>"web",
        ]);

        Permission::Create([
            'name' => 'dashboard' ,
            'guard_name' =>"web",
        ]);
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin_models =
            [
                "academies",
                "activity_logs",
                "attendances",
                "branches",
                "branch_metas",
                "brokers",
                "categories",
                "cities",
                "clients",
                "contacts",
                "countries",
                "courses",
                "currencies",
                "employees",
                "employee_contracts",
                "employee_details",
                "employee_finances",
                "employee_managements",
                "employee_types",
                "employee_vacations",
                "experiences",
                "grades",
                "groups",
                "jobs",
                "job_types",
                "job_names",
                "job_grades",
                "managements",
                "qualifications",
                "day_shifts",
                "days",
                "shifts",
                "states",
                "specialists",
                "universities",
                "vacations",
                "notifications",
                "works",
                "supports",
                "decisions",
                "orders",
                "pages",
                "posts",
                "roles",
                "services",
                "users",
                "logs",
            ];

        $permissions = [

            "users.view",
            "users.create",
            "users.edit",
            "users.delete",
            "users.active",


            "roles.view",
            "roles.create",
            "roles.edit",
            "roles.delete",

            "branches.view",
            "branches.create",
            "branches.edit",
            "branches.delete",

            "managements.view",
            "managements.create",
            "managements.edit",
            "managements.delete",


            "departments.view",
            "departments.create",
            "departments.edit",
            "departments.delete",


            "jobTypes.view",
            "jobTypes.create",
            "jobTypes.edit",
            "jobTypes.delete",

            "jobNames.view",
            "jobNames.create",
            "jobNames.edit",
            "jobNames.delete",

            "jobGrades.view",
            "jobGrades.create",
            "jobGrades.edit",
            "jobGrades.delete",

            "clients.view",
            "clients.create",
            "clients.edit",
            "clients.delete",

            "brokers.view",
            "brokers.create",
            "brokers.edit",
            "brokers.delete",


            "employees.view",
            "employees.create",
            "employees.edit",
            "employees.delete",

            "clientRequests.view",
            "clientRequests.changeStatus",


            "dashboardSetting.view",
            "dashboardSetting.branches",

            "dashboardSetting.branches.officialPaper",
            "dashboardSetting.branches.officialPaper.edit",
            "dashboardSetting.branches.officialPaper.delete",

            "dashboardSetting.shift.view",
            "dashboardSetting.shift.create",
            "dashboardSetting.shift.edit",
            "dashboardSetting.shift.delete",

            "dashboardSetting.universities.view",
            "dashboardSetting.universities.create",
            "dashboardSetting.universities.edit",
            "dashboardSetting.universities.delete",

            "dashboardSetting.cities.view",
            "dashboardSetting.cities.create",
            "dashboardSetting.cities.edit",
            "dashboardSetting.cities.delete",


            "platforms.view",

            "platforms.services.view",
            "platforms.services.create",
            "platforms.services.edit",
            "platforms.services.delete",

            "platforms.projects.view",
            "platforms.projects.create",
            "platforms.projects.edit",
            "platforms.projects.delete",


            "platforms.projectTypes.view",
            "platforms.projectTypes.create",
            "platforms.projectTypes.edit",
            "platforms.projectTypes.delete",

            "platforms.news.view",
            "platforms.news.create",
            "platforms.news.edit",
            "platforms.news.delete",

            "platforms.icons.view",
            "platforms.icons.create",
            "platforms.icons.edit",
            "platforms.icons.delete",


            "platforms.members.view",
            "platforms.members.create",
            "platforms.members.edit",
            "platforms.members.delete",

            "platforms.banners.view",
            "platforms.banners.create",
            "platforms.banners.edit",
            "platforms.banners.delete",


            "platforms.categories.view",
            "platforms.categories.create",
            "platforms.categories.edit",
            "platforms.categories.delete",


            "platforms.intrenalNews.view",
            "platforms.intrenalNews.create",
            "platforms.intrenalNews.edit",
            "platforms.intrenalNews.delete",

            "platforms.mainPage.edit",
            "platforms.aboutUs.edit",


            "platforms.website.settings",
            "platforms.website.reports",

            "attendance.view",

            "attendance.requests.view",
            "attendance.requests.create",
            "attendance.requests.edit",
            "attendance.requests.delete",
            "attendance.requests.changeStatus",

            "attendance.support.view",
            "attendance.support.create",
            "attendance.support.edit",
            "attendance.support.delete",
            "attendance.support.changeStatus",

            "tickets.view",
            "tickets.create",
            "tickets.edit",
            "tickets.delete",
            "tickets.changeStatus",

            "gada.agreements.view",
            "gada.agreements.create",
            "gada.agreements.edit",
            "gada.agreements.delete",


        ];


         foreach ($permissions as  $name => $method) {
                Permission::Create([
                    'name' => $method,
                    'guard_name' =>"web",
                ]);
            }

//        $this->addModelsCrud($admin_models);
//        $this->addModelsNotCrud();

        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account_admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'office_admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account_manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'office_manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account',
                'guard_name' => 'web',
            ],
            [
                'name' => 'office',
                'guard_name' => 'web',
            ],
        ];


        foreach ($roles as $key => $value) {
            $role = Role::create($value);
            if($role['id'] == 1){
                $pers = Permission::pluck('id', 'id')->toArray();
                $role->permissions()->sync($pers);
            }
        }

        $password = Hash::make('password');

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@vision.com',
            'active' =>true,
            'password' => $password,
        ]);
        $user->assignRole(Role::where('name','admin')->value('id'));

        $user = \App\Models\User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@vision.com',
            'password' => $password,
        ]);
        $user->assignRole(Role::where('name','manager')->value('id'));

        $user = \App\Models\User::factory()->create([
            'name' => 'account_admin',
            'email' => 'account_admin@vision.com',
            'password' => $password,
        ]);
        $user->assignRole(Role::where('name','account_admin')->value('id'));

        $user = \App\Models\User::factory()->create([
            'name' => 'office_admin',
            'email' => 'office_admin@vision.com',
            'password' => $password,
        ]);
        $user->assignRole(Role::where('name','office_admin')->value('id'));


        $grades = [
            [
                'name' => 'الدرجة الاولى',
                'active' => 1,
            ],
            [
                'name' => 'الدرجة الثانية',
                'active' => 1,
            ],
            [
                'name' => 'الدرجة الثالثة',
                'active' => 1,
            ],
            [
                'name' => 'الدرجة الرابعة',
                'active' => 1,
            ],
            [
                'name' => 'الدرجة الخامسة',
                'active' => 1,
            ],
            [
                'name' => 'الدرجة السادسة',
                'active' => 1,
            ],
            // [
            //     'name' => 'الدرجة السابعة',
            //     'active' => 1,
            // ],
            // [
            //     'name' => 'الدرجة الثامنة',
            //     'active' => 1,
            // ],
            // [
            //     'name' => 'الدرجة التاسعة',
            //     'active' => 1,
            // ],
            // [
            //     'name' => 'الدرجة العاشرة',
            //     'active' => 1,
            // ],
        ];

        foreach ($grades as $key => $value) {

            Grade::create($value);
        }

        $settings = [
            [
                'type' => 'site_open',
                'key' => 'site_open',
                'value' => 'yes',
                'group' => 'setting',
            ],
            [
                'type' => 'site_title',
                'key' => 'site_title',
                'value' => 'Corptia',
                'group' => 'setting',
            ],
            [
                'type' => 'site_url',
                'key' => 'site_url',
                'value' => 'http://127.0.0.1:8000',
                'group' => 'setting',
            ],
            [
                'type' => 'website_url',
                'key' => 'website_url',
                'value' => 'http://127.0.0.1:8000',
                'group' => 'setting',
            ],
            [
                'type' => 'admin_url',
                'key' => 'admin_url',
                'value' => 'admin',
                'group' => 'setting',
            ],
            [
                'type' => 'admin_language',
                'key' => 'admin_language',
                'value' => 'ar',
                'group' => 'setting',
            ],
            [
                'type' => 'table_limit',
                'key' => 'table_limit',
                'value' => '100',
                'group' => 'setting',
            ],
            [
                'type' => 'ssl_certificate',
                'key' => 'ssl_certificate',
                'value' => 'no',
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'emails',
                'value' => ['vision22@support.com'],
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'phones',
                'value' => ['01029936932'],
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'logo',
                'value' => '',
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'whatsapp',
                'value' => ['01029936932'],
                'group' => 'social',
                'autoload' => 1,
            ],
            [
                'type' => 'user_type_debug',
                'key' => 'user_type_debug',
                'value' => 'admin',
                'group' => 'setting',
            ],
            [
                'type' => 'user_id_debug',
                'key' => 'user_id_debug',
                'value' => '1',
                'group' => 'setting',
            ],
            [
                'type' => 'app_debug',
                'key' => 'app_debug',
                'value' => 'yes',
                'group' => 'setting',
            ],
            [
                'type' => 'delay_start',
                'key' => 'delay_start',
                'value' => '120',
                'group' => 'setting',
            ],
            [
                'type' => 'shift_start', // that can attend after start shift after value mintues
                'key' => 'shift_start',
                'value' => '30',
                'group' => 'setting',
            ],
            [
                'type' => 'shift_end', // that can end attend after end shift after value mintues
                'key' => 'shift_end',
                'value' => '30',
                'group' => 'setting',
            ],
            [
                'type' => 'work_start',
                'key' => 'work_start',
                'value' => '90',
                'group' => 'setting',
            ],
            [
                'type' => 'work_end',
                'key' => 'work_end',
                'value' => '90',
                'group' => 'setting',
            ],
            [
                'type' => 'extra_after_shift_end',
                'key' => 'extra_after_shift_end',
                'value' => '60',
                'group' => 'setting',
            ],
            [
                'type' => 'extra_before_shift_end',
                'key' => 'extra_before_shift_end',
                'value' => '60',
                'group' => 'setting',
            ],
            [
                'type' => 'alert_time',
                'key' => 'alert_time',
                'value' => '60',
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'address',
                'value' => 'المملكة العربية السعودية جدة / ش البلدية مركز القمة لإدارة الأعمال',
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'slogan',
                'value' => 'شركة إستشارات هندسية',
                'group' => 'setting',
            ],
            [
                'type' => 'website',
                'key' => 'name',
                'value' => 'شركة أبعاد للإستشارات الهندسية',
                'group' => 'setting',
            ],
            [
                'type' => 'dashboard',
                'key' => 'requests_limit',
                'value' => '3',
                'group' => 'setting',
            ]
        ];


//        foreach ($settings as $key => $value) {
//            Setting::create($value);
//        }

        $countries = array(
            array('name' => 'Egypt','iso3' => 'EGY','numeric_code' => '818','iso2' => 'EG','phonecode' => '20','capital' => 'Cairo','currency' => 'EGP','currency_name' => 'Egyptian pound','currency_symbol' => 'ج.م','tld' => '.eg','native' => 'مصر‎','region' => 'Africa','subregion' => 'Northern Africa','timezones' => '[{"zoneName":"Africa/Cairo","gmtOffset":7200,"gmtOffsetName":"UTC+02:00","abbreviation":"EET","tzName":"Eastern European Time"}]','translations' => '{"kr":"이집트","pt-BR":"Egito","pt":"Egipto","nl":"Egypte","hr":"Egipat","fa":"مصر","de":"Ägypten","es":"Egipto","fr":"Égypte","ja":"エジプト","it":"Egitto","cn":"埃及","tr":"Mısır"}','latitude' => '27.00000000','longitude' => '30.00000000','emoji' => '🇪🇬','emojiU' => 'U+1F1EA U+1F1EC','flag' => '1','wikiDataId' => 'Q79'),
            array('name' => 'Saudi Arabia','iso3' => 'SAU','numeric_code' => '682','iso2' => 'SA','phonecode' => '966','capital' => 'Riyadh','currency' => 'SAR','currency_name' => 'Saudi riyal','currency_symbol' => '﷼','tld' => '.sa','native' => 'المملكة العربية السعودية','region' => 'Asia','subregion' => 'Western Asia','timezones' => '[{"zoneName":"Asia/Riyadh","gmtOffset":10800,"gmtOffsetName":"UTC+03:00","abbreviation":"AST","tzName":"Arabia Standard Time"}]','translations' => '{"kr":"사우디아라비아","pt-BR":"Arábia Saudita","pt":"Arábia Saudita","nl":"Saoedi-Arabië","hr":"Saudijska Arabija","fa":"عربستان سعودی","de":"Saudi-Arabien","es":"Arabia Saudí","fr":"Arabie Saoudite","ja":"サウジアラビア","it":"Arabia Saudita","cn":"沙特阿拉伯","tr":"Suudi Arabistan"}','latitude' => '25.00000000','longitude' => '45.00000000','emoji' => '🇸🇦','emojiU' => 'U+1F1F8 U+1F1E6','flag' => '1','wikiDataId' => 'Q851')
        );

        $states = array(
            array('name' => 'Kafr el-Sheikh','country_id' => '1','country_code' => 'EG','fips_code' => '21','iso2' => 'KFS','type' => NULL,'latitude' => '31.30854440','longitude' => '30.80394740','flag' => '1','wikiDataId' => 'Q30946'),
            array('name' => 'Cairo','country_id' => '1','country_code' => 'EG','fips_code' => '11','iso2' => 'C','type' => NULL,'latitude' => '29.95375640','longitude' => '31.53700030','flag' => '1','wikiDataId' => 'Q30805'),
            array('name' => 'Damietta','country_id' => '1','country_code' => 'EG','fips_code' => '20','iso2' => 'DT','type' => NULL,'latitude' => '31.36257990','longitude' => '31.67393710','flag' => '1','wikiDataId' => 'Q30644'),
            array('name' => 'Aswan','country_id' => '1','country_code' => 'EG','fips_code' => '16','iso2' => 'ASN','type' => NULL,'latitude' => '23.69664980','longitude' => '32.71813750','flag' => '1','wikiDataId' => 'Q29937'),
            array('name' => 'Sohag','country_id' => '1','country_code' => 'EG','fips_code' => '24','iso2' => 'SHG','type' => NULL,'latitude' => '26.69383400','longitude' => '32.17460500','flag' => '1','wikiDataId' => 'Q30669'),
            array('name' => 'North Sinai','country_id' => '1','country_code' => 'EG','fips_code' => '27','iso2' => 'SIN','type' => NULL,'latitude' => '30.28236500','longitude' => '33.61757700','flag' => '1','wikiDataId' => 'Q30662'),
            array('name' => 'Monufia','country_id' => '1','country_code' => 'EG','fips_code' => '09','iso2' => 'MNF','type' => NULL,'latitude' => '30.59724550','longitude' => '30.98763210','flag' => '1','wikiDataId' => 'Q30786'),
            array('name' => 'Port Said','country_id' => '1','country_code' => 'EG','fips_code' => '19','iso2' => 'PTS','type' => NULL,'latitude' => '31.07586060','longitude' => '32.26538870','flag' => '1','wikiDataId' => 'Q31079'),
            array('name' => 'Beni Suef','country_id' => '1','country_code' => 'EG','fips_code' => '18','iso2' => 'BNS','type' => NULL,'latitude' => '28.89388370','longitude' => '31.44561790','flag' => '1','wikiDataId' => 'Q30683'),
            array('name' => 'Matrouh','country_id' => '1','country_code' => 'EG','fips_code' => '22','iso2' => 'MT','type' => NULL,'latitude' => '29.56963500','longitude' => '26.41938900','flag' => '1','wikiDataId' => 'Q30682'),
            array('name' => 'Qalyubia','country_id' => '1','country_code' => 'EG','fips_code' => '12','iso2' => 'KB','type' => NULL,'latitude' => '30.32923680','longitude' => '31.21684660','flag' => '1','wikiDataId' => 'Q31075'),
            array('name' => 'Suez','country_id' => '1','country_code' => 'EG','fips_code' => '15','iso2' => 'SUZ','type' => NULL,'latitude' => '29.36822550','longitude' => '32.17460500','flag' => '1','wikiDataId' => 'Q31070'),
            array('name' => 'Gharbia','country_id' => '1','country_code' => 'EG','fips_code' => '05','iso2' => 'GH','type' => NULL,'latitude' => '30.87535560','longitude' => '31.03351000','flag' => '1','wikiDataId' => 'Q30835'),
            array('name' => 'Alexandria','country_id' => '1','country_code' => 'EG','fips_code' => '06','iso2' => 'ALX','type' => NULL,'latitude' => '30.87605680','longitude' => '29.74260400','flag' => '1','wikiDataId' => 'Q29943'),
            array('name' => 'Asyut','country_id' => '1','country_code' => 'EG','fips_code' => '17','iso2' => 'AST','type' => NULL,'latitude' => '27.21338310','longitude' => '31.44561790','flag' => '1','wikiDataId' => 'Q29965'),
            array('name' => 'South Sinai','country_id' => '1','country_code' => 'EG','fips_code' => '26','iso2' => 'JS','type' => NULL,'latitude' => '29.31018280','longitude' => '34.15319470','flag' => '1','wikiDataId' => 'Q30815'),
            array('name' => 'Faiyum','country_id' => '1','country_code' => 'EG','fips_code' => '04','iso2' => 'FYM','type' => NULL,'latitude' => '29.30840210','longitude' => '30.84284970','flag' => '1','wikiDataId' => 'Q30656'),
            array('name' => 'Giza','country_id' => '1','country_code' => 'EG','fips_code' => '08','iso2' => 'GZ','type' => NULL,'latitude' => '28.76662160','longitude' => '29.23207840','flag' => '1','wikiDataId' => 'Q30832'),
            array('name' => 'Red Sea','country_id' => '1','country_code' => 'EG','fips_code' => '02','iso2' => 'BA','type' => NULL,'latitude' => '24.68263160','longitude' => '34.15319470','flag' => '1','wikiDataId' => 'Q30831'),
            array('name' => 'Beheira','country_id' => '1','country_code' => 'EG','fips_code' => '03','iso2' => 'BH','type' => NULL,'latitude' => '30.84809860','longitude' => '30.34355060','flag' => '1','wikiDataId' => 'Q30630'),
            array('name' => 'Luxor','country_id' => '1','country_code' => 'EG','fips_code' => '28','iso2' => 'LX','type' => NULL,'latitude' => '25.39444440','longitude' => '32.49200880','flag' => '1','wikiDataId' => 'Q30797'),
            array('name' => 'Minya','country_id' => '1','country_code' => 'EG','fips_code' => '10','iso2' => 'MN','type' => NULL,'latitude' => '28.28472900','longitude' => '30.52790960','flag' => '1','wikiDataId' => 'Q30675'),
            array('name' => 'Ismailia','country_id' => '1','country_code' => 'EG','fips_code' => '07','iso2' => 'IS','type' => NULL,'latitude' => '30.58309340','longitude' => '32.26538870','flag' => '1','wikiDataId' => 'Q31067'),
            array('name' => 'Dakahlia','country_id' => '1','country_code' => 'EG','fips_code' => '01','iso2' => 'DK','type' => NULL,'latitude' => '31.16560440','longitude' => '31.49131820','flag' => '1','wikiDataId' => 'Q31068'),
            array('name' => 'New Valley','country_id' => '1','country_code' => 'EG','fips_code' => '13','iso2' => 'WAD','type' => NULL,'latitude' => '24.54556380','longitude' => '27.17353160','flag' => '1','wikiDataId' => 'Q30650'),
            array('name' => 'Qena','country_id' => '1','country_code' => 'EG','fips_code' => '23','iso2' => 'KN','type' => NULL,'latitude' => '26.23460330','longitude' => '32.98883190','flag' => '1','wikiDataId' => 'Q31065'),
            array('name' => 'Riyadh','country_id' => '2','country_code' => 'SA','fips_code' => '10','iso2' => '01','type' => 'region','latitude' => '22.75543850','longitude' => '46.20915470','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q1249255'),
            array('name' => 'Makkah','country_id' => '2','country_code' => 'SA','fips_code' => '14','iso2' => '02','type' => 'region','latitude' => '21.52355840','longitude' => '41.91964710','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q234167'),
            array('name' => 'Al Madinah','country_id' => '2','country_code' => 'SA','fips_code' => '05','iso2' => '03','type' => 'region','latitude' => '24.84039770','longitude' => '39.32062410','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q236027'),
            array('name' => 'Tabuk','country_id' => '2','country_code' => 'SA','fips_code' => '19','iso2' => '07','type' => 'region','latitude' => '28.24533350','longitude' => '37.63866220','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q1315953'),
            array('name' => '\'Asir','country_id' => '2','country_code' => 'SA','fips_code' => '11','iso2' => '14','type' => 'region','latitude' => '19.09690620','longitude' => '42.86378750','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q779855'),
            array('name' => 'Northern Borders','country_id' => '2','country_code' => 'SA','fips_code' => '15','iso2' => '08','type' => 'region','latitude' => '30.07991620','longitude' => '42.86378750','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q201781'),
            array('name' => 'Ha\'il','country_id' => '2','country_code' => 'SA','fips_code' => '13','iso2' => '06','type' => 'region','latitude' => '27.70761430','longitude' => '41.91964710','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q243656'),
            array('name' => 'Eastern Province','country_id' => '2','country_code' => 'SA','fips_code' => '06','iso2' => '04','type' => 'region','latitude' => '24.04399320','longitude' => '45.65892250','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q953508'),
            array('name' => 'Al Jawf','country_id' => '2','country_code' => 'SA','fips_code' => '20','iso2' => '12','type' => 'region','latitude' => '29.88735600','longitude' => '39.32062410','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q1471266'),
            array('name' => 'Jizan','country_id' => '2','country_code' => 'SA','fips_code' => '17','iso2' => '09','type' => 'region','latitude' => '17.17381760','longitude' => '42.70761070','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q269973'),
            array('name' => 'Al Bahah','country_id' => '2','country_code' => 'SA','fips_code' => '02','iso2' => '11','type' => 'region','latitude' => '20.27227390','longitude' => '41.44125100','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q852774'),
            array('name' => 'Najran','country_id' => '2','country_code' => 'SA','fips_code' => '16','iso2' => '10','type' => 'region','latitude' => '18.35146640','longitude' => '45.60071080','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q464718'),
            array('name' => 'Al-Qassim','country_id' => '2','country_code' => 'SA','fips_code' => '08','iso2' => '05','type' => 'region','latitude' => '26.20782600','longitude' => '43.48373800','created_at' => '2019-10-06 02:18:50','updated_at' => '2022-11-13 17:04:39','flag' => '1','wikiDataId' => 'Q1105411'),
        );
        $cities = array(
            array('name' => 'Abnūb','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '27.26960000','longitude' => '31.15105000','flag' => '1','wikiDataId' => 'Q975904'),
            array('name' => 'Abu Simbel','state_id' => '3225','state_code' => 'ASN','country_id' => '1','country_code' => 'EG','latitude' => '22.34570000','longitude' => '31.61624000','flag' => '1','wikiDataId' => 'Q6655437'),
            array('name' => 'Abū Qurqāş','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '27.93120000','longitude' => '30.83841000','flag' => '1','wikiDataId' => 'Q3646152'),
            array('name' => 'Abū Tīj','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '27.04411000','longitude' => '31.31897000','flag' => '1','wikiDataId' => 'Q3502865'),
            array('name' => 'Abū al Maţāmīr','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '30.91018000','longitude' => '30.17438000','flag' => '1','wikiDataId' => 'Q3502865'),
            array('name' => 'Ad Dilinjāt','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '30.82796000','longitude' => '30.53552000','flag' => '1','wikiDataId' => 'Q23955761'),
            array('name' => 'Ain Sukhna','state_id' => '3233','state_code' => 'SUZ','country_id' => '1','country_code' => 'EG','latitude' => '29.60018000','longitude' => '32.31671000','flag' => '1','wikiDataId' => 'Q23955761'),
            array('name' => 'Ajā','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '30.94162000','longitude' => '31.29039000','flag' => '1','wikiDataId' => 'Q10961074'),
            array('name' => 'Akhmīm','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.56217000','longitude' => '31.74503000','flag' => '1','wikiDataId' => 'Q31865526'),
            array('name' => 'Al Badārī','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '26.99257000','longitude' => '31.41554000','flag' => '1','wikiDataId' => 'Q31865526'),
            array('name' => 'Al Balyanā','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.23568000','longitude' => '32.00347000','flag' => '1','wikiDataId' => 'Q2210877'),
            array('name' => 'Al Bawīţī','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '28.34919000','longitude' => '28.86591000','flag' => '1','wikiDataId' => 'Q4116186'),
            array('name' => 'Al Bājūr','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.43046000','longitude' => '31.03679000','flag' => '1','wikiDataId' => 'Q4164479'),
            array('name' => 'Al Fashn','state_id' => '3230','state_code' => 'BNS','country_id' => '1','country_code' => 'EG','latitude' => '28.82431000','longitude' => '30.89948000','flag' => '1','wikiDataId' => 'Q953625'),
            array('name' => 'Al Fayyūm','state_id' => '3238','state_code' => 'FYM','country_id' => '1','country_code' => 'EG','latitude' => '29.30995000','longitude' => '30.84180000','flag' => '1','wikiDataId' => 'Q203299'),
            array('name' => 'Al Jammālīyah','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.18065000','longitude' => '31.86497000','flag' => '1','wikiDataId' => 'Q203299'),
            array('name' => 'Al Khānkah','state_id' => '3232','state_code' => 'KB','country_id' => '1','country_code' => 'EG','latitude' => '30.21035000','longitude' => '31.36812000','flag' => '1','wikiDataId' => 'Q23955433'),
            array('name' => 'Al Khārijah','state_id' => '3246','state_code' => 'WAD','country_id' => '1','country_code' => 'EG','latitude' => '25.45141000','longitude' => '30.54635000','flag' => '1','wikiDataId' => 'Q4063326'),
            array('name' => 'Al Manshāh','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.47686000','longitude' => '31.80350000','flag' => '1','wikiDataId' => 'Q23955470'),
            array('name' => 'Al Manzalah','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.15823000','longitude' => '31.93600000','flag' => '1','wikiDataId' => 'Q3494688'),
            array('name' => 'Al Manşūrah','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.03637000','longitude' => '31.38069000','flag' => '1','wikiDataId' => 'Q223587'),
            array('name' => 'Al Maţarīyah','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.18287000','longitude' => '32.03108000','flag' => '1','wikiDataId' => 'Q23955475'),
            array('name' => 'Al Maḩallah al Kubrá','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.97063000','longitude' => '31.16690000','flag' => '1','wikiDataId' => 'Q312723'),
            array('name' => 'Al Minyā','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '28.10988000','longitude' => '30.75030000','flag' => '1','wikiDataId' => 'Q310117'),
            array('name' => 'Al Qanāţir al Khayrīyah','state_id' => '3232','state_code' => 'KB','country_id' => '1','country_code' => 'EG','latitude' => '30.19327000','longitude' => '31.13703000','flag' => '1','wikiDataId' => 'Q23955489'),
            array('name' => 'Al Quşayr','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '26.10426000','longitude' => '34.27793000','flag' => '1','wikiDataId' => 'Q310751'),
            array('name' => 'Al Qūşīyah','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '27.44020000','longitude' => '30.81841000','flag' => '1','wikiDataId' => 'Q310844'),
            array('name' => 'Al Wāsiţah','state_id' => '3238','state_code' => 'FYM','country_id' => '1','country_code' => 'EG','latitude' => '29.33778000','longitude' => '31.20556000','flag' => '1','wikiDataId' => 'Q4105094'),
            array('name' => 'Al Ḩawāmidīyah','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '29.90000000','longitude' => '31.25000000','flag' => '1','wikiDataId' => 'Q23955406'),
            array('name' => 'Al Ḩāmūl','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.31146000','longitude' => '31.14766000','flag' => '1','wikiDataId' => 'Q23955404'),
            array('name' => 'Al ‘Alamayn','state_id' => '3231','state_code' => 'MT','country_id' => '1','country_code' => 'EG','latitude' => '30.83007000','longitude' => '28.95502000','flag' => '1','wikiDataId' => 'Q204439'),
            array('name' => 'Al ‘Ayyāţ','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '29.61972000','longitude' => '31.25750000','flag' => '1','wikiDataId' => 'Q23955572'),
            array('name' => 'Alexandria','state_id' => '3235','state_code' => 'ALX','country_id' => '1','country_code' => 'EG','latitude' => '31.20176000','longitude' => '29.91582000','flag' => '1','wikiDataId' => 'Q87'),
            array('name' => 'Arish','state_id' => '3227','state_code' => 'SIN','country_id' => '1','country_code' => 'EG','latitude' => '31.13159000','longitude' => '33.79844000','flag' => '1','wikiDataId' => 'Q238452'),
            array('name' => 'Ash Shuhadā’','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.59683000','longitude' => '30.89931000','flag' => '1','wikiDataId' => 'Q7504702'),
            array('name' => 'Ashmūn','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.29735000','longitude' => '30.97641000','flag' => '1','wikiDataId' => 'Q951186'),
            array('name' => 'Aswan','state_id' => '3225','state_code' => 'ASN','country_id' => '1','country_code' => 'EG','latitude' => '24.09082000','longitude' => '32.89942000','flag' => '1','wikiDataId' => 'Q29888'),
            array('name' => 'Asyūţ','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '27.18096000','longitude' => '31.18368000','flag' => '1','wikiDataId' => 'Q29962'),
            array('name' => 'Awsīm','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '30.12303000','longitude' => '31.13571000','flag' => '1','wikiDataId' => 'Q10423667'),
            array('name' => 'Az Zarqā','state_id' => '3224','state_code' => 'DT','country_id' => '1','country_code' => 'EG','latitude' => '31.20864000','longitude' => '31.63528000','flag' => '1','wikiDataId' => 'Q4119153'),
            array('name' => 'Aş Şaff','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '29.56472000','longitude' => '31.28111000','flag' => '1','wikiDataId' => 'Q23955229'),
            array('name' => 'Banhā','state_id' => '3232','state_code' => 'KB','country_id' => '1','country_code' => 'EG','latitude' => '30.45977000','longitude' => '31.18420000','flag' => '1','wikiDataId' => 'Q336966'),
            array('name' => 'Banī Mazār','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '28.50360000','longitude' => '30.80040000','flag' => '1','wikiDataId' => 'Q951324'),
            array('name' => 'Banī Suwayf','state_id' => '3230','state_code' => 'BNS','country_id' => '1','country_code' => 'EG','latitude' => '29.07441000','longitude' => '31.09785000','flag' => '1','wikiDataId' => 'Q394080'),
            array('name' => 'Basyūn','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.93976000','longitude' => '30.81338000','flag' => '1','wikiDataId' => 'Q1072210'),
            array('name' => 'Bilqās','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.21452000','longitude' => '31.35798000','flag' => '1','wikiDataId' => 'Q950839'),
            array('name' => 'Būsh','state_id' => '3230','state_code' => 'BNS','country_id' => '1','country_code' => 'EG','latitude' => '29.14816000','longitude' => '31.12733000','flag' => '1','wikiDataId' => 'Q63233'),
            array('name' => 'Cairo','state_id' => '3223','state_code' => 'C','country_id' => '1','country_code' => 'EG','latitude' => '30.06263000','longitude' => '31.24967000','flag' => '1','wikiDataId' => 'Q85'),
            array('name' => 'Dahab','state_id' => '3237','state_code' => 'JS','country_id' => '1','country_code' => 'EG','latitude' => '28.48208000','longitude' => '34.49505000','flag' => '1','wikiDataId' => 'Q370495'),
            array('name' => 'Damanhūr','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '31.03408000','longitude' => '30.46823000','flag' => '1','wikiDataId' => 'Q328153'),
            array('name' => 'Damietta','state_id' => '3224','state_code' => 'DT','country_id' => '1','country_code' => 'EG','latitude' => '31.41648000','longitude' => '31.81332000','flag' => '1','wikiDataId' => 'Q189383'),
            array('name' => 'Dayr Mawās','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '27.64176000','longitude' => '30.84662000','flag' => '1','wikiDataId' => 'Q3652748'),
            array('name' => 'Dayrūţ','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '27.55602000','longitude' => '30.80764000','flag' => '1','wikiDataId' => 'Q951804'),
            array('name' => 'Dikirnis','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.08898000','longitude' => '31.59478000','flag' => '1','wikiDataId' => 'Q23952236'),
            array('name' => 'Dishnā','state_id' => '3247','state_code' => 'KN','country_id' => '1','country_code' => 'EG','latitude' => '26.12467000','longitude' => '32.47598000','flag' => '1','wikiDataId' => 'Q23951929'),
            array('name' => 'Disūq','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.13259000','longitude' => '30.64784000','flag' => '1','wikiDataId' => 'Q23951808'),
            array('name' => 'El Gouna','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '27.39417000','longitude' => '33.67825000','flag' => '1','wikiDataId' => 'Q286510'),
            array('name' => 'El-Tor','state_id' => '3237','state_code' => 'JS','country_id' => '1','country_code' => 'EG','latitude' => '28.24168000','longitude' => '33.62220000','flag' => '1','wikiDataId' => 'Q867603'),
            array('name' => 'Farshūţ','state_id' => '3247','state_code' => 'KN','country_id' => '1','country_code' => 'EG','latitude' => '26.05494000','longitude' => '32.16329000','flag' => '1','wikiDataId' => 'Q23951614'),
            array('name' => 'Fuwwah','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.20365000','longitude' => '30.54908000','flag' => '1','wikiDataId' => 'Q23951368'),
            array('name' => 'Fāraskūr','state_id' => '3224','state_code' => 'DT','country_id' => '1','country_code' => 'EG','latitude' => '31.32977000','longitude' => '31.71507000','flag' => '1','wikiDataId' => 'Q4166604'),
            array('name' => 'Giza','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '30.00808000','longitude' => '31.21093000','flag' => '1','wikiDataId' => 'Q81788'),
            array('name' => 'Hurghada','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '27.25738000','longitude' => '33.81291000','flag' => '1','wikiDataId' => 'Q187284'),
            array('name' => 'Ibshawāy','state_id' => '3238','state_code' => 'FYM','country_id' => '1','country_code' => 'EG','latitude' => '29.35896000','longitude' => '30.68061000','flag' => '1','wikiDataId' => 'Q23949980'),
            array('name' => 'Idfū','state_id' => '3225','state_code' => 'ASN','country_id' => '1','country_code' => 'EG','latitude' => '24.97916000','longitude' => '32.87722000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q239107'),
            array('name' => 'Idkū','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '31.30730000','longitude' => '30.29810000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q2988951'),
            array('name' => 'Ismailia','state_id' => '3244','state_code' => 'IS','country_id' => '1','country_code' => 'EG','latitude' => '30.60427000','longitude' => '32.27225000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q217156'),
            array('name' => 'Isnā','state_id' => '3247','state_code' => 'KN','country_id' => '1','country_code' => 'EG','latitude' => '25.29336000','longitude' => '32.55402000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q626031'),
            array('name' => 'Iţsā','state_id' => '3238','state_code' => 'FYM','country_id' => '1','country_code' => 'EG','latitude' => '29.23760000','longitude' => '30.78944000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q23950077'),
            array('name' => 'Jirjā','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.33826000','longitude' => '31.89161000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q749187'),
            array('name' => 'Juhaynah','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.67319000','longitude' => '31.49760000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q23949850'),
            array('name' => 'Kafr ad Dawwār','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '31.13379000','longitude' => '30.12969000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q31915573'),
            array('name' => 'Kafr ash Shaykh','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.11174000','longitude' => '30.93991000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q31915573'),
            array('name' => 'Kafr az Zayyāt','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.82480000','longitude' => '30.81805000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q951867'),
            array('name' => 'Kawm Umbū','state_id' => '3225','state_code' => 'ASN','country_id' => '1','country_code' => 'EG','latitude' => '24.47669000','longitude' => '32.94626000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q138833'),
            array('name' => 'Kawm Ḩamādah','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '30.76128000','longitude' => '30.69972000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q23949640'),
            array('name' => 'Kousa','state_id' => '3247','state_code' => 'KN','country_id' => '1','country_code' => 'EG','latitude' => '25.91407000','longitude' => '32.76362000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q1816589'),
            array('name' => 'Luxor','state_id' => '3242','state_code' => 'LX','country_id' => '1','country_code' => 'EG','latitude' => '25.69893000','longitude' => '32.64210000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q130514'),
            array('name' => 'Madīnat Sittah Uktūbar','state_id' => '3239','state_code' => 'GZ','country_id' => '1','country_code' => 'EG','latitude' => '29.81667000','longitude' => '31.05000000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q130514'),
            array('name' => 'Makadi Bay','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '26.99123000','longitude' => '33.89952000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q1521754'),
            array('name' => 'Mallawī','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '27.73140000','longitude' => '30.84165000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q393498'),
            array('name' => 'Manfalūţ','state_id' => '3236','state_code' => 'AST','country_id' => '1','country_code' => 'EG','latitude' => '27.31040000','longitude' => '30.97004000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q556095'),
            array('name' => 'Markaz Disūq','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.14590000','longitude' => '30.71609000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q556095'),
            array('name' => 'Markaz Jirjā','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.30683000','longitude' => '31.84574000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q556095'),
            array('name' => 'Markaz Sūhāj','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.53948000','longitude' => '31.67524000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q556095'),
            array('name' => 'Markaz al Uqşur','state_id' => '3242','state_code' => 'LX','country_id' => '1','country_code' => 'EG','latitude' => '25.62986000','longitude' => '32.59017000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q556095'),
            array('name' => 'Marsa Alam','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '25.06305000','longitude' => '34.89005000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q1001901'),
            array('name' => 'Maţāy','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '28.41899000','longitude' => '30.77924000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q3498842'),
            array('name' => 'Mersa Matruh','state_id' => '3231','state_code' => 'MT','country_id' => '1','country_code' => 'EG','latitude' => '31.35290000','longitude' => '27.23725000','created_at' => '2019-10-06 03:15:31','updated_at' => '2019-10-06 03:15:31','flag' => '1','wikiDataId' => 'Q393829'),
            array('name' => 'Minyat an Naşr','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.12624000','longitude' => '31.64313000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q950786'),
            array('name' => 'Munshāt ‘Alī Āghā','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.15791000','longitude' => '30.70177000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q950786'),
            array('name' => 'Munūf','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.46597000','longitude' => '30.93199000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q951268'),
            array('name' => 'Naja\' Ḥammādī','state_id' => '3247','state_code' => 'KN','country_id' => '1','country_code' => 'EG','latitude' => '26.04949000','longitude' => '32.24142000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q270754'),
            array('name' => 'Nuwaybi‘a','state_id' => '3237','state_code' => 'JS','country_id' => '1','country_code' => 'EG','latitude' => '29.04681000','longitude' => '34.66340000','created_at' => '2019-10-06 03:15:31','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q1011488'),
            array('name' => 'Port Said','state_id' => '3229','state_code' => 'PTS','country_id' => '1','country_code' => 'EG','latitude' => '31.25654000','longitude' => '32.28411000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q134509'),
            array('name' => 'Qalyūb','state_id' => '3232','state_code' => 'KB','country_id' => '1','country_code' => 'EG','latitude' => '30.17922000','longitude' => '31.20560000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q336724'),
            array('name' => 'Qaşr al Farāfirah','state_id' => '3246','state_code' => 'WAD','country_id' => '1','country_code' => 'EG','latitude' => '27.05680000','longitude' => '27.96979000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q14208893'),
            array('name' => 'Qinā','state_id' => '3247','state_code' => 'KN','country_id' => '1','country_code' => 'EG','latitude' => '26.16418000','longitude' => '32.72671000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q336661'),
            array('name' => 'Quwaysinā','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.56482000','longitude' => '31.15777000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q7273033'),
            array('name' => 'Quţūr','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.97225000','longitude' => '30.95614000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q23938961'),
            array('name' => 'Ras Gharib','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '28.35831000','longitude' => '33.07829000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q1404020'),
            array('name' => 'Rosetta','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '31.39951000','longitude' => '30.41718000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q243699'),
            array('name' => 'Safaga','state_id' => '3240','state_code' => 'BA','country_id' => '1','country_code' => 'EG','latitude' => '26.74906000','longitude' => '33.93891000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q986325'),
            array('name' => 'Saint Catherine','state_id' => '3237','state_code' => 'JS','country_id' => '1','country_code' => 'EG','latitude' => '28.56191000','longitude' => '33.94934000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q986325'),
            array('name' => 'Samannūd','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.96160000','longitude' => '31.24069000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q1243772'),
            array('name' => 'Samālūţ','state_id' => '3243','state_code' => 'MN','country_id' => '1','country_code' => 'EG','latitude' => '28.31214000','longitude' => '30.71007000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q950924'),
            array('name' => 'Sharm el-Sheikh','state_id' => '3237','state_code' => 'JS','country_id' => '1','country_code' => 'EG','latitude' => '27.91582000','longitude' => '34.32995000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q644'),
            array('name' => 'Shibīn al Kawm','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.55258000','longitude' => '31.00904000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q31350'),
            array('name' => 'Shibīn al Qanāṭir','state_id' => '3232','state_code' => 'KB','country_id' => '1','country_code' => 'EG','latitude' => '30.31269000','longitude' => '31.32018000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q31350'),
            array('name' => 'Shirbīn','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.19688000','longitude' => '31.52430000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q1524502'),
            array('name' => 'Siwa Oasis','state_id' => '3231','state_code' => 'MT','country_id' => '1','country_code' => 'EG','latitude' => '29.20320000','longitude' => '25.51965000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q1524502'),
            array('name' => 'Sohag','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.55695000','longitude' => '31.69478000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q1524502'),
            array('name' => 'Suez','state_id' => '3233','state_code' => 'SUZ','country_id' => '1','country_code' => 'EG','latitude' => '29.97371000','longitude' => '32.52627000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q134514'),
            array('name' => 'Sumusţā as Sulţānī','state_id' => '3230','state_code' => 'BNS','country_id' => '1','country_code' => 'EG','latitude' => '28.91667000','longitude' => '30.85000000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q23935303'),
            array('name' => 'Sīdī Sālim','state_id' => '3222','state_code' => 'KFS','country_id' => '1','country_code' => 'EG','latitude' => '31.27133000','longitude' => '30.78617000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q23936898'),
            array('name' => 'Talā','state_id' => '3228','state_code' => 'MNF','country_id' => '1','country_code' => 'EG','latitude' => '30.67980000','longitude' => '30.94364000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q7678737'),
            array('name' => 'Tanda','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.78847000','longitude' => '31.00192000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q271771'),
            array('name' => 'Toukh','state_id' => '3232','state_code' => 'KB','country_id' => '1','country_code' => 'EG','latitude' => '30.35487000','longitude' => '31.20105000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q23934694'),
            array('name' => 'Zefta','state_id' => '3234','state_code' => 'GH','country_id' => '1','country_code' => 'EG','latitude' => '30.71420000','longitude' => '31.24425000','created_at' => '2019-10-06 03:15:32','updated_at' => '2019-10-06 03:15:32','flag' => '1','wikiDataId' => 'Q2392142'),
            array('name' => 'Ţahţā','state_id' => '3226','state_code' => 'SHG','country_id' => '1','country_code' => 'EG','latitude' => '26.76930000','longitude' => '31.50214000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q951369'),
            array('name' => 'Ţalkhā','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.05390000','longitude' => '31.37787000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q952118'),
            array('name' => 'Ţāmiyah','state_id' => '3238','state_code' => 'FYM','country_id' => '1','country_code' => 'EG','latitude' => '29.47639000','longitude' => '30.96119000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q952118'),
            array('name' => 'Ḩawsh ‘Īsá','state_id' => '3241','state_code' => 'BH','country_id' => '1','country_code' => 'EG','latitude' => '30.91280000','longitude' => '30.29019000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q23950194'),
            array('name' => '‘Izbat al Burj','state_id' => '3245','state_code' => 'DK','country_id' => '1','country_code' => 'EG','latitude' => '31.50840000','longitude' => '31.84106000','created_at' => '2019-10-06 03:15:32','updated_at' => '2020-05-01 21:52:42','flag' => '1','wikiDataId' => 'Q1010823'),
            array('name' => 'Abha','state_id' => '2853','state_code' => '14','country_id' => '2','country_code' => 'SA','latitude' => '18.21639000','longitude' => '42.50528000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q190948'),
            array('name' => 'Abqaiq','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.93402000','longitude' => '49.66880000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q27177'),
            array('name' => 'Abū ‘Arīsh','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '16.96887000','longitude' => '42.83251000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q2821731'),
            array('name' => 'Ad Darb','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '17.72285000','longitude' => '42.25261000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q31868833'),
            array('name' => 'Ad Dawādimī','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '24.50772000','longitude' => '44.39237000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q27258'),
            array('name' => 'Ad Dilam','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '23.99104000','longitude' => '47.16181000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q31868886'),
            array('name' => 'Adh Dhibiyah','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '26.02700000','longitude' => '43.15700000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q31868886'),
            array('name' => 'Afif','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '23.90650000','longitude' => '42.91724000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q27139'),
            array('name' => 'Ain AlBaraha','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '24.75806000','longitude' => '43.77389000','created_at' => '2019-10-06 03:47:54','updated_at' => '2021-09-26 21:24:00','flag' => '1','wikiDataId' => 'Q20394853'),
            array('name' => 'Al Arţāwīyah','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '26.50387000','longitude' => '45.34813000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31871949'),
            array('name' => 'Al Awjām','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.56324000','longitude' => '49.94331000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q4164621'),
            array('name' => 'Al Bahah','state_id' => '2859','state_code' => '11','country_id' => '2','country_code' => 'SA','latitude' => '20.01288000','longitude' => '41.46767000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q27176'),
            array('name' => 'Al Baţţālīyah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.43333000','longitude' => '49.63333000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31872122'),
            array('name' => 'Al Bukayrīyah','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '26.13915000','longitude' => '43.65782000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31872259'),
            array('name' => 'Al Fuwayliq','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '26.44360000','longitude' => '43.25164000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q31872595'),
            array('name' => 'Al Hadā','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.36753000','longitude' => '40.28694000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q4703935'),
            array('name' => 'Al Hufūf','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.36467000','longitude' => '49.58764000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q27136'),
            array('name' => 'Al Jafr','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.37736000','longitude' => '49.72154000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q31873138'),
            array('name' => 'Al Jarādīyah','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '16.57946000','longitude' => '42.91240000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q4704123'),
            array('name' => 'Al Jubayl','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '27.01740000','longitude' => '49.62251000','created_at' => '2019-10-06 03:47:54','updated_at' => '2019-10-06 03:47:54','flag' => '1','wikiDataId' => 'Q27430'),
            array('name' => 'Al Jumūm','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.61694000','longitude' => '39.69806000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q12185747'),
            array('name' => 'Al Khafjī','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '28.43905000','longitude' => '48.49132000','created_at' => '2019-10-06 03:47:54','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31873774'),
            array('name' => 'Al Kharj','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '24.15541000','longitude' => '47.33457000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q2162128'),
            array('name' => 'Al Majāridah','state_id' => '2853','state_code' => '14','country_id' => '2','country_code' => 'SA','latitude' => '19.12361000','longitude' => '41.91111000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31874518'),
            array('name' => 'Al Markaz','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.40000000','longitude' => '49.73333000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31874729'),
            array('name' => 'Al Mindak','state_id' => '2859','state_code' => '11','country_id' => '2','country_code' => 'SA','latitude' => '20.15880000','longitude' => '41.28337000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31875144'),
            array('name' => 'Al Mithnab','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '25.86012000','longitude' => '44.22228000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31875144'),
            array('name' => 'Al Mubarraz','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.40768000','longitude' => '49.59028000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31875209'),
            array('name' => 'Al Munayzilah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.38333000','longitude' => '49.66667000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31875344'),
            array('name' => 'Al Muwayh','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '22.43333000','longitude' => '41.75829000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31875487'),
            array('name' => 'Al Muţayrifī','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.47878000','longitude' => '49.55824000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31875523'),
            array('name' => 'Al Qaţīf','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.56542000','longitude' => '50.00890000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31875721'),
            array('name' => 'Al Qurayn','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.48333000','longitude' => '49.60000000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q31875811'),
            array('name' => 'Al Qārah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.41667000','longitude' => '49.66667000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31875851'),
            array('name' => 'Al Wajh','state_id' => '2852','state_code' => '07','country_id' => '2','country_code' => 'SA','latitude' => '26.24551000','longitude' => '36.45249000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q27251'),
            array('name' => 'Al-Ula','state_id' => '2851','state_code' => '03','country_id' => '2','country_code' => 'SA','latitude' => '26.60853000','longitude' => '37.92316000','created_at' => '2019-10-06 03:47:55','updated_at' => '2021-09-26 21:16:48','flag' => '1','wikiDataId' => 'Q27242'),
            array('name' => 'Ar Rass','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '25.86944000','longitude' => '43.49730000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q1878991'),
            array('name' => 'Arar','state_id' => '2854','state_code' => '08','country_id' => '2','country_code' => 'SA','latitude' => '30.97531000','longitude' => '41.03808000','created_at' => '2019-10-06 03:47:55','updated_at' => '2021-09-26 21:07:49','flag' => '1','wikiDataId' => 'Q626199'),
            array('name' => 'As Saffānīyah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '27.97083000','longitude' => '48.73000000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31890141'),
            array('name' => 'As Sulayyil','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '20.46067000','longitude' => '45.57792000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q27221'),
            array('name' => 'Ash Shafā','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.07210000','longitude' => '40.31185000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q4804436'),
            array('name' => 'At Tūbī','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.55778000','longitude' => '49.99167000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31892461'),
            array('name' => 'Az Zulfī','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '26.29945000','longitude' => '44.81542000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q31894563'),
            array('name' => 'Aţ Ţaraf','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.36232000','longitude' => '49.72757000','created_at' => '2019-10-06 03:47:55','updated_at' => '2021-09-26 20:56:02','flag' => '1','wikiDataId' => 'Q20381582'),
            array('name' => 'Buraydah','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '26.32599000','longitude' => '43.97497000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q259253'),
            array('name' => 'Dammam','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.43442000','longitude' => '50.10326000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q160320'),
            array('name' => 'Dhahran','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.28864000','longitude' => '50.11396000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q268915'),
            array('name' => 'Duba','state_id' => '2852','state_code' => '07','country_id' => '2','country_code' => 'SA','latitude' => '27.35134000','longitude' => '35.69014000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q268915'),
            array('name' => 'Farasān','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '16.70222000','longitude' => '42.11833000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q268915'),
            array('name' => 'Ghran','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.98027000','longitude' => '39.36521000','created_at' => '2019-10-06 03:47:55','updated_at' => '2021-09-26 21:20:00','flag' => '1','wikiDataId' => 'Q65065367'),
            array('name' => 'Hafar Al-Batin','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '28.43279000','longitude' => '45.97077000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q27400'),
            array('name' => 'Jeddah','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.54238000','longitude' => '39.19797000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q374365'),
            array('name' => 'Jizan','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '16.88917000','longitude' => '42.55111000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q27660'),
            array('name' => 'Julayjilah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '25.50000000','longitude' => '49.60000000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32130900'),
            array('name' => 'Khamis Mushait','state_id' => '2853','state_code' => '14','country_id' => '2','country_code' => 'SA','latitude' => '18.30000000','longitude' => '42.73333000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q759381'),
            array('name' => 'Khobar','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.27944000','longitude' => '50.20833000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q311266'),
            array('name' => 'Marāt','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '25.07064000','longitude' => '45.45775000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32139417'),
            array('name' => 'Mecca','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.42664000','longitude' => '39.82563000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q5806'),
            array('name' => 'Medina','state_id' => '2851','state_code' => '03','country_id' => '2','country_code' => 'SA','latitude' => '24.46861000','longitude' => '39.61417000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q35484'),
            array('name' => 'Mislīyah','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '17.45988000','longitude' => '42.55720000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32140978'),
            array('name' => 'Mizhirah','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '16.82611000','longitude' => '42.73333000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32141037'),
            array('name' => 'Mulayjah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '27.27103000','longitude' => '48.42419000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32141302'),
            array('name' => 'Najrān','state_id' => '2860','state_code' => '10','country_id' => '2','country_code' => 'SA','latitude' => '17.49326000','longitude' => '44.12766000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q27174'),
            array('name' => 'Qaisumah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '28.31117000','longitude' => '46.12729000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q3543647'),
            array('name' => 'Qurayyat','state_id' => '2857','state_code' => '12','country_id' => '2','country_code' => 'SA','latitude' => '31.33176000','longitude' => '37.34282000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q2829401'),
            array('name' => 'Raḩīmah','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.70791000','longitude' => '50.06194000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q2829401'),
            array('name' => 'Riyadh','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '24.68773000','longitude' => '46.72185000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q3692'),
            array('name' => 'Rābigh','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '22.79856000','longitude' => '39.03493000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q27274'),
            array('name' => 'Sakakah','state_id' => '2857','state_code' => '12','country_id' => '2','country_code' => 'SA','latitude' => '29.96974000','longitude' => '40.20641000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q27469'),
            array('name' => 'Sājir','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '25.18251000','longitude' => '44.59964000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32188864'),
            array('name' => 'Tabuk','state_id' => '2852','state_code' => '07','country_id' => '2','country_code' => 'SA','latitude' => '28.39980000','longitude' => '36.57151000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q244232'),
            array('name' => 'Tabālah','state_id' => '2853','state_code' => '14','country_id' => '2','country_code' => 'SA','latitude' => '19.95000000','longitude' => '42.40000000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32189185'),
            array('name' => 'Tanūmah','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '27.10000000','longitude' => '44.13333000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32189686'),
            array('name' => 'Ta\'if','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.27028000','longitude' => '40.41583000','created_at' => '2019-10-06 03:47:55','updated_at' => '2021-09-26 21:20:38','flag' => '1','wikiDataId' => 'Q182640'),
            array('name' => 'Tumayr','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '25.70347000','longitude' => '45.86835000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32190410'),
            array('name' => 'Turabah','state_id' => '2850','state_code' => '02','country_id' => '2','country_code' => 'SA','latitude' => '21.21406000','longitude' => '41.63310000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32190427'),
            array('name' => 'Turaif','state_id' => '2854','state_code' => '08','country_id' => '2','country_code' => 'SA','latitude' => '31.67252000','longitude' => '38.66374000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32190427'),
            array('name' => 'Tārūt','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.57330000','longitude' => '50.04028000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32190514'),
            array('name' => 'Umm Lajj','state_id' => '2852','state_code' => '07','country_id' => '2','country_code' => 'SA','latitude' => '25.02126000','longitude' => '37.26850000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32190969'),
            array('name' => 'Umm as Sāhik','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.65361000','longitude' => '49.91639000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32190880'),
            array('name' => 'Wed Alnkil','state_id' => '2861','state_code' => '05','country_id' => '2','country_code' => 'SA','latitude' => '25.42670000','longitude' => '42.83430000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q32190880'),
            array('name' => 'Yanbu','state_id' => '2851','state_code' => '03','country_id' => '2','country_code' => 'SA','latitude' => '24.08954000','longitude' => '38.06180000','created_at' => '2019-10-06 03:47:55','updated_at' => '2019-10-06 03:47:55','flag' => '1','wikiDataId' => 'Q466027'),
            array('name' => 'shokhaibٍ','state_id' => '2849','state_code' => '01','country_id' => '2','country_code' => 'SA','latitude' => '24.49023000','longitude' => '46.26871000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q466027'),
            array('name' => 'Şabyā','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '17.14950000','longitude' => '42.62537000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32219237'),
            array('name' => 'Şafwá','state_id' => '2856','state_code' => '04','country_id' => '2','country_code' => 'SA','latitude' => '26.64970000','longitude' => '49.95522000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q27234'),
            array('name' => 'Şuwayr','state_id' => '2857','state_code' => '12','country_id' => '2','country_code' => 'SA','latitude' => '30.11713000','longitude' => '40.38925000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q32219471'),
            array('name' => 'Şāmitah','state_id' => '2858','state_code' => '09','country_id' => '2','country_code' => 'SA','latitude' => '16.59601000','longitude' => '42.94435000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q4164177'),
            array('name' => 'Ţubarjal','state_id' => '2857','state_code' => '12','country_id' => '2','country_code' => 'SA','latitude' => '30.49987000','longitude' => '38.21603000','created_at' => '2019-10-06 03:47:55','updated_at' => '2020-05-01 21:53:14','flag' => '1','wikiDataId' => 'Q4164177'),
        );

        foreach ($countries as $country){
            Country::create($country) ;
        }
        foreach ($states as $state){
            State::create($state) ;
        }
        foreach ($cities as $city){
            $state = State::where('iso2',$city['state_code'])->first();
            $city['state_id'] = $state->id;
            City::create($city) ;
        }
        $universities = [
            "Cairo University",
            "Alexandria University",
            "Ain Shams University",
            "Helwan University",
            "Assiut University",
            "Zagazig University",
            "Mansoura University",
            "Tanta University",
            "Suez Canal University",
            "Benha University",
            "Minia University",
            "Sohag University",
            "South Valley University",
            "Fayoum University",
            "Aswan University",
            "Banha University",
            "Damietta University",
            "Port Said University",
            "Kafr Elsheikh University",
            "October 6 University",
            "Menofia University"
            // Add more universities here...
        ];

        foreach ($universities as $university ){
            University::create(['name'=>$university]);
        }

        $statuses = ['accepted'=>'active','denied'=>'stopped','pending'=>'late'];

        foreach ($statuses as $status => $color){
            Status::create(['name'=>$status,'type'=>'requests','color'=>$color]);
        }
        $employeeStatuses = ['accepted'=>'active','denied'=>'stopped','pending'=>'late'];

        foreach ($employeeStatuses as $status => $color){
            Status::create(['name'=>$status,'type'=>'employee-requests','color'=>$color]);
        }

        $ticketStatuses = ['resolved'=>'active','denied'=>'stopped','pending'=>'late'];

        foreach ($ticketStatuses as $stat => $color){
            Status::create(['name'=>$stat,'type'=>'tickets','color'=>$color]);
        }

//        $projectTypes = ['عقد رخص','رخصة بناء','عرض سعر'];
//        foreach ($projectTypes as $type ){
//            ProjectType::create(['name'=>$type]);
//        }

        Currency::factory(3)->create();
        Branch::factory(10)->has(Management::factory()->count(3)->has(Department::factory()->count(3),'departments'),'managements')->create();
        // Shift::factory(10)->create();

        \App\Models\Client::factory()->create([
            'type' => 'individual',
            'name' => 'client',
            'email' => 'client@vision.com',
            'phone_verified_at' => now(),
            'phone' => '01098281638',
            'lang' => 'ar',
            'card_id' => '1234567890',
            'active' => 1 ,
            'password' => $password,
            'from' => 'test'
        ]);
        \App\Models\Client::factory()->create([
            'type' => 'company',
            'name' => 'company',
            'email' => 'comapny@vision.com',
            'phone_verified_at' => now(),
            'phone' => '01098281638',
            'lang' => 'ar',
            'register_number' => '1234567890',
            'active' => 1 ,
            'password' => $password,
            'from' => 'test'
        ]);

    }
}
