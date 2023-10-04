<?php

use Illuminate\Http\Request;
use Modules\Projects\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/projects', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'api/admin', 'as' => 'api.admin.','middleware'=>'auth'], function () {

//Route::apiResource('messages', MessagesController::class);

//Route::post('chat', 'MessagesController@chat')->name('chat');
//
//Route::post('chat/send', 'MessagesController@send')->name('chat.send');

});
