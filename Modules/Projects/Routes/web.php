<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>'auth'], function () {

    Route::get('projects/{project}/chat', 'MessagesController@chat')->name('chat');
    Route::get('messages/{id}/react', 'MessagesController@getReact')->name('getReact');
    Route::post('messages/{id}/react/', 'MessagesController@react')->name('react');

    Route::post('chat', 'MessagesController@messages')->name('messages');

    Route::post('chat/users', 'MessagesController@users')->name('chat.users');
    Route::post('chat/user', 'MessagesController@user')->name('chat.user');
    Route::post('chat/project', 'MessagesController@project')->name('chat.project');

    Route::post('chat/send', 'MessagesController@send')->name('chat.send');
//    Route::post('chat/send-file', 'MessagesController@file')->name('chat.file');


    Route::get('workspace/{id}/', 'ProjectsController@workspace' )->name('workspace');
    Route::get('projects/{id}/items', 'ProjectsController@workspace')->name('items');

    Route::get('tasks/{task}/assign', 'TasksController@assign' )->name('assign');
    Route::post('tasks/{task}/assign', 'TasksController@assignGo' )->name('assignGo');


    Route::resource('projects', 'ProjectsController');
    Route::resource('contracts', 'ContractController');
    Route::resource('tasks', 'TasksController');
    Route::resource('items', 'ItemsController');

    // get managements
    Route::get('/get_managements/{branch_id}','ContractController@get_managements');
    // suggestions for contract type
    Route::get('/get_contract_types','ContractController@get_contract_types');
    // get Transfered Contracts
    Route::get('/get_contracts/{type?}','ContractController@index')->name('contract.type');
    //save items in cache
    Route::post('/save-items','ContractController@saveItems')->name('contract.saveItems');
    //save payments in cache
    Route::get('/save-payments','ContractController@savePayments')->name('contract.savePayments');
    //contracts bulk delete
    Route::post('/bulk_delete','ContractController@bulk_destroy')->name('contract.bulkDelete');

});
