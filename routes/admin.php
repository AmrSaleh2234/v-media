<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\BrokerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\DecisionController;
use App\Http\Controllers\Admin\AcademyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\JobNameController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\JobGradeController;
use App\Http\Controllers\Admin\VacationController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Admin\AjaxStatusController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BranchMetaController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Admin\EmployeeFinanceController;
use App\Http\Controllers\Admin\EmployeeContractController;
use App\Http\Controllers\Admin\EmployeeVacationController;
use App\Http\Controllers\Admin\EmployeeManagementController;
use App\Http\Controllers\Admin\ShiftController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$admin_url = 'admin';
Route::group([
    'middleware' => ['guest'],
    'namespace' => 'Auth',
], function () use ($admin_url) {
    // Auth Admin
    Route::get($admin_url . '/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post($admin_url . '/check', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'check'])->middleware("throttle:5,1");
    Route::get($admin_url . '/check/again', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'check'])->middleware("throttle:5,1")->name('admin.check.again');
    Route::get($admin_url . '/check', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'checkLoginForm'])->name('admin.check');
    Route::post($admin_url . '/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->middleware("throttle:5,1");
});
//'check.lastactive.admin',
Route::group([
    'prefix' => $admin_url,
    'as' => 'admin.',
    // 'namespace' => 'Admin',
    'middleware' => ['auth:web', 'active'],
    //'site.open','auto-check-permission',
], function () use ($admin_url) {

    Route::group([
        'prefix' => 'users',
        'as' => 'users.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('create');
        Route::get('/edit/{user_id}', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('edit');
    });

    Route::group([
        'prefix' => 'roles',
        'as' => 'roles.',
    ], function () {
        Route::get('/index', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('create');
        Route::get('/edit/{role_id}', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('edit');
    });


    Route::get('optimize', function () {
        Artisan::call('optimize:clear');
        return 'done';
    });

    Route::post($admin_url . '/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');


    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/notifications', [\App\Http\Controllers\Admin\DashboardController::class, 'notifications'])->name('notifications');


    Route::group([
        'prefix' => 'settings',
        'as' => 'settings.',
        // 'middleware' => ['access.all'],
    ], function () {

        Route::get('/dashboard', [SettingController::class, 'dashboard'])->name('dashboard');
        Route::group([
            'prefix' => 'dashboard',
            'as' => 'dashboard.',
            // 'middleware' => ['access.all'],
        ], function () {


            Route::get('/branches', [SettingController::class, 'branches'])->name('branches');
            Route::get('/official-papers', [SettingController::class, 'papers'])->name('official-papers');
            Route::get('/attendance', [SettingController::class, 'attendance'])->name('attendance');


            Route::get('/settings/shifts', [SettingController::class, 'shift_settings_index'])->name('shifts.index');
            Route::get('/settings/shifts/create/{shift_id?}', [SettingController::class, 'shift_settings_create'])->name('shifts.create');

            Route::resource('/universities', \App\Http\Controllers\Admin\Setting\UniversitiesController::class);
            Route::resource('/cities', \App\Http\Controllers\Admin\Setting\CitiesController::class);

        });

            Route::group([
                "prefix" => "website",
                "as" => "website."
            ], function () {
                Route::get('', [\App\Http\Controllers\Admin\Setting\WebsiteController::class, 'website'])->name('website');
                Route::get('/setting', [\App\Http\Controllers\Admin\Setting\WebsiteController::class, 'setting'])->name('setting');


                Route::get('main-page', [PageController::class, 'mainPage'])->name('main-page');
                Route::get('about-us', [PageController::class, 'aboutUs'])->name('about-us');
                Route::get('contact-us', [PageController::class, 'contactUs'])->name('contact-us');
                Route::get('service-page', [PageController::class, 'servicePage'])->name('service-page');

                Route::group([
                    "prefix" => "reports",
                    "as" => "reports."
                ], function () {
                    Route::get('contact-us', [\App\Http\Controllers\Admin\Setting\ReportsController::class, 'contactUs'])->name('contact-us');
                    Route::get('services', [\App\Http\Controllers\Admin\Setting\ReportsController::class, 'services'])->name('services');
                    Route::get('subscribers', [\App\Http\Controllers\Admin\Setting\ReportsController::class, 'subscribers'])->name('subscribers');

                });
            });

            Route::get('platforms/', [SettingController::class, 'platforms'])->name('platforms');
            Route::group([
                'prefix' => 'platforms',
                'as' => 'platforms.',
                // 'middleware' => ['access.all'],
            ], function () {
//            Route::get('/', [\App\Http\Controllers\Admin\SettingController::class, 'website'])->name('website');


//            Route::get('main-page', [SettingController::class, 'mainPage'])->name('main-page');

                Route::resource('projects', \App\Http\Controllers\Admin\Setting\ProjectsSetting::class);
                Route::resource('projects_types', \App\Http\Controllers\Admin\Setting\ProjectTypesSetting::class);

                Route::resource('services', \App\Http\Controllers\Admin\Setting\ServicesController::class);
                Route::resource('news', \App\Http\Controllers\Admin\Setting\NewsController::class);
                Route::resource('icons', \App\Http\Controllers\Admin\Setting\IconController::class);
                Route::resource('members', \App\Http\Controllers\Admin\Setting\MemberController::class);
                Route::resource('banners', \App\Http\Controllers\Admin\Setting\BannerController::class);
                Route::resource('categories', \App\Http\Controllers\Admin\Setting\CategoryController::class);

                Route::resource('internal-news', \App\Http\Controllers\Admin\Setting\InternalNewsController::class);
            });
            Route::get('social', [SettingController::class, 'social'])->name('social');
            Route::post('social', [SettingController::class, 'socialStore'])->name('social.store');
        });

//    Route::resource('notifications', NotificationController::class, ['except' => ['edit', 'update']]);

        Route::group([
            'prefix' => 'attendance',
            'as' => 'attendance.',
        ], function () {
            Route::get('/', [\App\Http\Controllers\Admin\AttendanceController::class, 'table'])->name('table');
            Route::resource('/requests', \App\Http\Controllers\Admin\Attendance\EmployeeRequestsController::class);
            Route::resource('/support', \App\Http\Controllers\Admin\Attendance\SupportController::class);


        });

    Route::group([
        'prefix' => 'gada',
        'as' => 'gada.',
    ], function () {
        Route::get('/agreements', [\App\Http\Controllers\Admin\GADA\AgreementsController::class,'index'])->name('agreements.index');

    });
        Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
        Route::get('users/export/', [\App\Http\Controllers\Admin\DashboardController::class, 'export'])->name('users.export');

        Route::delete('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
        // Route::delete('users/{id}/delete', [UserController::class,'delete'])->name('users.delete');
        Route::get('users/profile', [UserController::class, 'editProfile'])->name('users.edit.profile');
        Route::patch('users/profile', [UserController::class, 'updateProfile'])->name('users.update.profile');
        Route::post('branchstatus', [AjaxStatusController::class, 'branchStatus'])->name('branchstatus');
        Route::post('userstatus', [AjaxStatusController::class, 'userStatus'])->name('userstatus');
        Route::post('categorystatus', [AjaxStatusController::class, 'categoryStatus'])->name('categorystatus');
        Route::post('servicestatus', [AjaxStatusController::class, 'serviceStatus'])->name('servicestatus');
        Route::post('poststatus', [AjaxStatusController::class, 'postStatus'])->name('poststatus');
        Route::post('postfeature', [AjaxStatusController::class, 'postFeature'])->name('postfeature');
        Route::post('contactread', [AjaxStatusController::class, 'contactRead'])->name('contactread');
        Route::post('contactstatus', [AjaxStatusController::class, 'contactStatus'])->name('contactstatus');
        Route::get('users/type/{type}', [UserController::class, 'type'])->name('users.type');
        Route::get('users/profile', ['as' => 'users.edit.profile', 'uses' => 'UserController@editProfile']);
        Route::patch('users/profile', ['as' => 'users.update.profile', 'uses' => 'UserController@updateProfile']);
        Route::get('users/profile', [UserController::class, 'editProfile'])->name('users.edit.profile');
        Route::patch('users/profile', [UserController::class, 'updateProfile'])->name('users.update.profile');
        Route::get('users/client/{id}', [UserController::class, 'editClient'])->name('users.client.edit');
        Route::patch('users/client/{id}', [UserController::class, 'updateClient'])->name('users.client.update');

        Route::get('branches/setting', [BranchController::class, 'setting'])->name('branches.setting');
        Route::post('branches/setting', [BranchController::class, 'settingStore'])->name('branches.setting.store');
        Route::post('countrychange', [AjaxStatusController::class, 'countryChange'])->name('countrychange');
        Route::post('departmentchange', [AjaxStatusController::class, 'departmentChange'])->name('departmentchange');
        Route::post('managementchange', [AjaxStatusController::class, 'managementChange'])->name('managementchange');

        Route::get('job_types', [JobsController::class, 'jobTypes'])->name('job_types.index');
        Route::get('job_names', [JobsController::class, 'jobNames'])->name('job_names.index');
        Route::get('job_grades', [JobsController::class, 'jobGrades'])->name('job_grades.index');
        Route::get('job_types/{id}', [JobsController::class, 'showJobTypes'])->name('job_types.show');
        Route::get('job_names/{id}', [JobsController::class, 'showJobNames'])->name('job_names.show');
        Route::get('job_grades/{id}', [JobsController::class, 'showJobGrades'])->name('job_grades.show');
        Route::get('clients/requests', [ClientController::class, 'requests'])->name('clients.requests');
        Route::get('clients/requests/{requestId}', [ClientController::class, 'showRequest'])->name('clients.requests.show');

        Route::resource('currencies', CurrencyController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('states', StateController::class);
        Route::resource('cities', CityController::class);
        Route::resource('shifts', ShiftController::class);
        Route::resource('support', SupportController::class);
        Route::resource('works', WorkController::class);
        Route::resource('decisions', DecisionController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('contracts', ContractController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('universities', UniversityController::class);
        Route::resource('qualifications', QualificationController::class);
        Route::resource('specialists', SpecialistController::class);
        Route::resource('academies', AcademyController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('groups', GroupController::class);
        //Route::resource('attendances', AttendanceController::class);
        Route::resource('brokers', BrokerController::class);
        Route::resource('managements', ManagementController::class);

        // Custom Api For Managements
        Route::get('/show/managements/{branch_id}', [ManagementController::class, 'index'])->name('branch.managements');

        Route::resource('experiences', ExperienceController::class);
        Route::resource('vacations', VacationController::class);
        Route::get('employees/create/steps/{number}/{employee?}', [EmployeeController::class, 'create'])->name('employees.createSteps');
        // Route::get('employees/create/steps/{number}/{employee?}', ['as' => 'employees.createSteps', 'uses' => '\App\Http\Controllers\Admin\EmployeeController@create']);
        Route::resource('employees', EmployeeController::class);
        Route::get('employees/create/{employee_id?}/{step?}', [EmployeeController::class, 'create'])->name('custom.create');


        Route::get('/employee/attendance', [AttendanceController::class, 'index'])->name('employee.attendances');

        Route::resource('employee_types', EmployeeTypeController::class);
        Route::resource('employee_managements', EmployeeManagementController::class);
        Route::resource('employee_contracts', EmployeeContractController::class);
        Route::resource('employee_finances', EmployeeFinanceController::class);
        Route::resource('employee_vacations', EmployeeVacationController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('grades', GradeController::class);

        Route::resource('categories', CategoryController::class);
        Route::resource('branches', BranchController::class);
        Route::resource('branch_metas', BranchMetaController::class, ['except' => ['index', 'create', 'show']]);
        Route::resource('services', ServiceController::class);
        Route::resource('posts', PostController::class);
        Route::resource('pages', PageController::class);
        Route::resource('contacts', ContactController::class, ['only' => ['index']]);
        Route::resource('orders', OrderController::class, ['except' => ['create', 'store']]);
        // Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::get('test', [\App\Http\Controllers\Admin\TestController::class, 'test'])->name('test');

    });

// Auth::routes([
//     'verify' => true,
// ]);
