<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get("test",function(Request $request) {
        $timezone = timezone($request->ip());
        $date = Carbon::now();
        $timezoneServerDate = $date->format("H:i A");
        $date->timezone($timezone);
        $formattedDate = $date->format('H:i A');
        echo  '<p>Your IP : ' . timezone($request->ip()) . '<\p>';
        echo '<br>';
        echo '<p>Your Date in time zone : ' . $formattedDate  . '<\p>';
        echo '<br>';
        echo '<p>Server Date with his timezone : ' . $timezoneServerDate  . '<\p>';
});


Auth::routes();

Route::get('/login', function () {
    return redirect('/admin/login');
});

Route::group([
    'middleware' => ['auth:web'],
    'namespace' => 'Auth',
], function () {

    Route::get('/', function () {
        return redirect('/admin');
    });

    Route::post('temp/process/', [\App\Http\Controllers\FileUploadController::class, 'process'])->name('upload.process');
    Route::delete('temp/delete', [\App\Http\Controllers\FileUploadController::class, 'delete'])->name('upload.delete');
//    Route::get('/download/{path}', [\App\Http\Controllers\FileUploadController::class, 'download'])->name('download');

    Route::post('download/', [\App\Http\Controllers\FileUploadController::class, 'download'])->name('download');

//    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});





