<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => [ 'json.response','from.header']], function () {

    Route::post('check', [\App\Http\Controllers\Api\Client\AuthController::class, 'check']);
    Route::post('confirm', [\App\Http\Controllers\Api\Client\AuthController::class, 'confirm']);
    Route::post('register', [\App\Http\Controllers\Api\Client\AuthController::class, 'register']);
    Route::post('branches', [\App\Http\Controllers\Api\Client\AuthController::class, 'branches']);

});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//
//    return $request->user();
//});
$client_url = 'client';

Route::group([
    'prefix' => $client_url,
    'as' => 'client.',
    'middleware' => ['json.response','from.header']], function () {

    Route::post('/setting', [\App\Http\Controllers\Api\Client\SettingController::class, 'setting'])->name('setting');
    Route::post('/setting/get', [\App\Http\Controllers\Api\Client\SettingController::class, 'getSetting'])->name('getSetting');
    Route::post('/main-page', [\App\Http\Controllers\Api\Client\SettingController::class, 'mainPage'])->name('main-page');
    Route::post('/about-page', [\App\Http\Controllers\Api\Client\SettingController::class, 'aboutPage'])->name('about-page');

    Route::post('/subscribe', [\App\Http\Controllers\Api\Client\SettingController::class, 'subscribe'])->name('subscribe');
    Route::post('/contact', [\App\Http\Controllers\Api\Client\SettingController::class, 'contact'])->name('contact');
    Route::post('/service-request', [\App\Http\Controllers\Api\Client\SettingController::class, 'requestService'])->name('services.requests');

    Route::post('/services/list', [\App\Http\Controllers\Api\Client\ServiceController::class, 'list'])->name('services.list');
    Route::apiResource('services', \App\Http\Controllers\Api\Client\ServiceController::class);

    Route::get('/service-page', [\App\Http\Controllers\Api\Client\ServiceController::class , 'servicePage'] );

    Route::post('/company-projects/list', [\App\Http\Controllers\Api\Client\CompanyProjectController::class, 'list'])->name('services.list');
    Route::apiResource('company-projects', \App\Http\Controllers\Api\Client\CompanyProjectController::class);

    Route::post('/banners/list', [\App\Http\Controllers\Api\Client\BannerController::class, 'list'])->name('banners.list');
    Route::apiResource('banners', \App\Http\Controllers\Api\Client\BannerController::class);

    Route::post('/news/list', [\App\Http\Controllers\Api\Client\NewsController::class, 'list'])->name('news.list');
    Route::apiResource('news', \App\Http\Controllers\Api\Client\NewsController::class);
    Route::post('/icons/list', [\App\Http\Controllers\Api\Client\IconController::class, 'list'])->name('icons.list');
    Route::apiResource('icons', \App\Http\Controllers\Api\Client\IconController::class);
    Route::post('/members/list', [\App\Http\Controllers\Api\Client\MemberController::class, 'list'])->name('members.list');
    Route::apiResource('members', \App\Http\Controllers\Api\Client\MemberController::class);



    Route::group([
        'middleware' => ['auth:api-client','scopes:client']], function () {

        Route::post('/logout', [\App\Http\Controllers\Api\Client\AuthController::class, 'logout']);

        Route::post('/delete-account', [\App\Http\Controllers\Api\Client\DashboardController::class, 'deleteAccount']);

        Route::post('/', [\App\Http\Controllers\Api\Client\DashboardController::class, 'index'])->name('index');
        Route::post('/user', [\App\Http\Controllers\Api\Client\DashboardController::class, 'user'])->name('user');

        Route::post('/profile', [\App\Http\Controllers\Api\Client\DashboardController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [\App\Http\Controllers\Api\Client\DashboardController::class, 'updateProfile'])->name('profile.update');


        Route::get('/agreements', [\App\Http\Controllers\Api\GADA\AgreementsController::class, 'index'])->name('agreements');

    });
});

$employee_url = 'employee';

Route::group([
    'prefix' => $employee_url,
    'as' => 'employee.',
    'middleware' => ['json.response']], function () {

    Route::post('login', [\App\Http\Controllers\Api\Employee\AuthController::class, 'login']);
    Route::post('/support', [\App\Http\Controllers\Api\Employee\AuthController::class, 'support'])->name('support');


    Route::group([
        'middleware' => ['auth:api', 'scopes:employee']], function () {
        Route::post('/logout', [\App\Http\Controllers\Api\Employee\AuthController::class, 'logout']);
        Route::post('/delete-account', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'deleteAccount']);
        Route::post('/', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'index'])->name('index');
        Route::post('/user', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'user'])->name('user');
        Route::post('/requests', [\App\Http\Controllers\Api\Employee\EmployeeRequestsController::class, 'requests'])->name('requests');
        Route::post('/requests/create', [\App\Http\Controllers\Api\Employee\EmployeeRequestsController::class, 'createRequest'])->name('requests-create ');

//        Route::post('/profile', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'profile'])->name('profile');
//        Route::post('/profile/update', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'updateProfile'])->name('profile.update');


        // Attendance
        Route::get('/get-attendance-info',[\App\Http\Controllers\Api\Employee\AttendanceController::class, 'getAttendanceInfo'])->name('attendance-info');
        Route::post('/attend', [\App\Http\Controllers\Api\Employee\AttendanceController::class,'storeAttendance'])->name('attend');


        Route::post('/attend/reports',[\App\Http\Controllers\Api\Employee\AttendanceController::class,'getAttendReport'])->name('attend-report');

        Route::get('/status',[\App\Http\Controllers\Api\Employee\AttendanceController::class,'getEmpStatus'])->name('emp-status');


        Route::get('/internal-news',[\App\Http\Controllers\Api\Employee\InternalNewsController::class, 'index'])->name('internal-news');
        Route::get('/notifications',[\App\Http\Controllers\Api\Employee\DashboardController::class, 'notifications'])->name('notifications');

        Route::get('/offline',[\App\Http\Controllers\Api\Employee\AttendanceController::class,'offline'])->name('offline');
        Route::get('/online',[\App\Http\Controllers\Api\Employee\AttendanceController::class,'online'])->name('online');

    });
});
