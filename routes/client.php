<?php

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


$client_url = 'client';
Route::group([
    'middleware' => ['guest'],
], function () use ($client_url) {
    // Auth Admin
    Route::get($client_url . '/login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'showLoginForm'])->name('client.login');
    Route::post($client_url . '/check', [\App\Http\Controllers\Client\Auth\LoginController::class, 'check'])->middleware("throttle:5,1");
    Route::get($client_url . '/check/again', [\App\Http\Controllers\Client\Auth\LoginController::class, 'checkAgain'])->middleware("throttle:5,1")->name('client.check.again');
    Route::get($client_url . '/check', [\App\Http\Controllers\Client\Auth\LoginController::class, 'checkLoginForm'])->name('client.check');
    Route::post($client_url . '/login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'login'])->middleware("throttle:5,1");
    Route::post($client_url . '/logout', [\App\Http\Controllers\Client\Auth\LoginController::class, 'logout'])->name('client.logout');
});


Route::group([
    'prefix' => $client_url,
    'as' => 'client.',
    'middleware' => [ 'auth:client', 'client', 'active'] ], function () {

    Route::post('/logout', [\App\Http\Controllers\Client\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('index');
    Route::get('/account', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('my-account');

});
