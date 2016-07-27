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
    
    Route::post('change/status', ['as' => 'change.status', 'uses' => 'Controller@changeStaus']);

    
    Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);
});
