<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@getLogin']);
Route::post('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@postLogin']);
Route::group(['prefix' => 'admin/', 'middleware' => ['web']], function() {
    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

    Route::get('menu/list', ['as' => 'menu.list', 'uses' => 'Admin\CMSMenuController@index']);
    Route::post('menu/list', ['as' => 'menu.list', 'uses' => 'Admin\CMSMenuController@getData']);
    Route::get('menu/create', ['as' => 'menu.create', 'uses' => 'Admin\CMSMenuController@create']);
    Route::post('menu/save', ['as' => 'menu.save', 'uses' => 'Admin\CMSMenuController@store']);
    Route::get('menu/edit/{id}', ['as' => 'menu.edit', 'uses' => 'Admin\CMSMenuController@edit']);
    Route::post('menu/update/{id}', ['as' => 'menu.update', 'uses' => 'Admin\CMSMenuController@update']);
    Route::get('menu/show/{id}', ['as' => 'menu.show', 'uses' => 'Admin\CMSMenuController@show']);
    Route::delete('menu/destroy/{id}', ['as' => 'menu.destroy', 'uses' => 'Admin\CMSMenuController@destroy']);

    Route::get('service/list', ['as' => 'service.list', 'uses' => 'Admin\OurServicesController@index']);
    Route::post('service/list', ['as' => 'service.list', 'uses' => 'Admin\OurServicesController@getData']);
    Route::get('service/create', ['as' => 'service.create', 'uses' => 'Admin\OurServicesController@create']);
    Route::post('service/save', ['as' => 'service.save', 'uses' => 'Admin\OurServicesController@store']);
    Route::get('service/edit/{id}', ['as' => 'service.edit', 'uses' => 'Admin\OurServicesController@edit']);
    Route::post('service/update/{id}', ['as' => 'service.update', 'uses' => 'Admin\OurServicesController@update']);
    Route::get('service/show/{id}', ['as' => 'service.show', 'uses' => 'Admin\OurServicesController@show']);
    Route::delete('service/destroy/{id}', ['as' => 'service.destroy', 'uses' => 'Admin\OurServicesController@destroy']);

    Route::get('workflow/list', ['as' => 'workflow.list', 'uses' => 'Admin\WorkFlowController@index']);
    Route::post('workflow/list', ['as' => 'workflow.list', 'uses' => 'Admin\WorkFlowController@getData']);
    Route::get('workflow/create', ['as' => 'workflow.create', 'uses' => 'Admin\WorkFlowController@create']);
    Route::post('workflow/save', ['as' => 'workflow.save', 'uses' => 'Admin\WorkFlowController@store']);
    Route::get('workflow/edit/{id}', ['as' => 'workflow.edit', 'uses' => 'Admin\WorkFlowController@edit']);
    Route::post('workflow/update/{id}', ['as' => 'workflow.update', 'uses' => 'Admin\WorkFlowController@update']);
    Route::get('workflow/show/{id}', ['as' => 'workflow.show', 'uses' => 'Admin\WorkFlowController@show']);
    Route::delete('workflow/destroy/{id}', ['as' => 'workflow.destroy', 'uses' => 'Admin\WorkFlowController@destroy']);
    
    Route::get('office/list', ['as' => 'office.list', 'uses' => 'Admin\OurOfficesController@index']);
    Route::post('office/list', ['as' => 'office.list', 'uses' => 'Admin\OurOfficesController@getData']);
    Route::get('office/create', ['as' => 'office.create', 'uses' => 'Admin\OurOfficesController@create']);
    Route::post('office/save', ['as' => 'office.save', 'uses' => 'Admin\OurOfficesController@store']);
    Route::get('office/edit/{id}', ['as' => 'office.edit', 'uses' => 'Admin\OurOfficesController@edit']);
    Route::post('office/update/{id}', ['as' => 'office.update', 'uses' => 'Admin\OurOfficesController@update']);
    Route::get('office/show/{id}', ['as' => 'office.show', 'uses' => 'Admin\OurOfficesController@show']);
    Route::delete('office/destroy/{id}', ['as' => 'office.destroy', 'uses' => 'Admin\OurOfficesController@destroy']);
    
    Route::post('change/status', ['as' => 'change.status', 'uses' => 'Controller@changeStatus']);
    Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);
});
