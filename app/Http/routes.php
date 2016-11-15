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

Route::get('/',array('as' => '/', 'uses' => 'HomeController@index'));
Route::get('/image/{folder}/{width}/{height}/{file}', array('as' => 'getimage', 'uses' => 'Controller@getImage'));
Route::get('/services',array('as' => 'services', 'uses' => 'ServicesController@index'));
Route::get('/projects',array('as' => 'projects', 'uses' => 'ProjectsController@index'));
Route::get('/networks/{state?}/{district?}/{city?}',array('as' => 'networks', 'uses' => 'NetworkController@index'));
Route::post('/networks',array('as' => 'get-networks', 'uses' => 'NetworkController@showMap'));
Route::post('get/cities', ['as' => 'map-getcities', 'uses' => 'NetworkController@getCities']);
Route::post('get/districts', ['as' => 'map-getdistricts', 'uses' => 'NetworkController@getDistricts']);
Route::post('/routes/get-map',array('as' => 'get-map', 'uses' => 'NetworkController@getMap'));
Route::get('/services/{name}',array('as' => 'service-details', 'uses' => 'ServicesController@getDetails'));
Route::get('/projects/{name}',array('as' => 'project-details', 'uses' => 'ProjectsController@getDetails'));
Route::get('/contact-us',array('as' => 'contactus', 'uses' => 'HomeController@contactus'));
Route::post('/post/contact',array('as' => 'post-contact', 'uses' => 'HomeController@postContactus'));
Route::get('/careers',array('as' => 'careers', 'uses' => 'HomeController@careers'));
Route::get('/job-details/{jobid}/{jobtitle}',array('as' => 'job-details', 'uses' => 'HomeController@jobDetails'));
Route::post('/post/careers',array('as' => 'post-careers', 'uses' => 'HomeController@postCareers'));


Route::post('file/temp/upload', array('as' => 'file.temp.upload', 'uses' => 'Controller@uploadToTemp'));
Route::post('file/temp/remove', array('as' => 'file.temp.remove', 'uses' => 'Controller@removeTempImage'));

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
    Route::get('menu/destroy/{id}', ['as' => 'menu.destroy', 'uses' => 'Admin\CMSMenuController@destroy']);

    Route::get('team/list', ['as' => 'team.list', 'uses' => 'Admin\TeamMemberController@index']);
    Route::post('team/list', ['as' => 'team.list', 'uses' => 'Admin\TeamMemberController@getData']);
    Route::get('team/create', ['as' => 'team.create', 'uses' => 'Admin\TeamMemberController@create']);
    Route::post('menu/save', ['as' => 'team.save', 'uses' => 'Admin\TeamMemberController@store']);
    Route::get('team/edit/{id}', ['as' => 'team.edit', 'uses' => 'Admin\TeamMemberController@edit']);
    Route::post('team/update/{id}', ['as' => 'team.update', 'uses' => 'Admin\TeamMemberController@update']);
    Route::get('team/show/{id}', ['as' => 'team.show', 'uses' => 'Admin\TeamMemberController@show']);
    Route::get('team/destroy/{id}', ['as' => 'team.destroy', 'uses' => 'Admin\TeamMemberController@destroy']);

    Route::get('slogan/list', ['as' => 'slogan.list', 'uses' => 'Admin\SloganController@index']);
    Route::post('slogan/list', ['as' => 'slogan.list', 'uses' => 'Admin\SloganController@getData']);
    Route::get('slogan/create', ['as' => 'slogan.create', 'uses' => 'Admin\SloganController@create']);
    Route::post('slogan/save', ['as' => 'slogan.save', 'uses' => 'Admin\SloganController@store']);
    Route::get('slogan/edit/{id}', ['as' => 'slogan.edit', 'uses' => 'Admin\SloganController@edit']);
    Route::post('slogan/update/{id}', ['as' => 'slogan.update', 'uses' => 'Admin\SloganController@update']);
    Route::get('slogan/show/{id}', ['as' => 'slogan.show', 'uses' => 'Admin\SloganController@show']);
    Route::get('slogan/destroy/{id}', ['as' => 'slogan.destroy', 'uses' => 'Admin\SloganController@destroy']);

    Route::post('state/districts', ['as' => 'state.districts.list', 'uses' => 'Admin\StateController@getDistricts']);
    Route::get('state/list', ['as' => 'state.list', 'uses' => 'Admin\StateController@index']);
    Route::post('state/list', ['as' => 'state.list', 'uses' => 'Admin\StateController@getData']);
    Route::get('state/create', ['as' => 'state.create', 'uses' => 'Admin\StateController@create']);
    Route::post('state/save', ['as' => 'state.save', 'uses' => 'Admin\StateController@store']);
    Route::get('state/edit/{id}', ['as' => 'state.edit', 'uses' => 'Admin\StateController@edit']);
    Route::post('state/update/{id}', ['as' => 'state.update', 'uses' => 'Admin\StateController@update']);
    Route::get('state/destroy/{id}', ['as' => 'state.destroy', 'uses' => 'Admin\StateController@destroy']);

    Route::get('district/list', ['as' => 'districts.list', 'uses' => 'Admin\DistrictController@index']);
    Route::post('district/list', ['as' => 'districts.list', 'uses' => 'Admin\DistrictController@getData']);
    Route::get('district/create', ['as' => 'districts.create', 'uses' => 'Admin\DistrictController@create']);
    Route::post('district/save', ['as' => 'districts.save', 'uses' => 'Admin\DistrictController@store']);
    Route::get('district/edit/{id}', ['as' => 'districts.edit', 'uses' => 'Admin\DistrictController@edit']);
    Route::post('district/update/{id}', ['as' => 'districts.update', 'uses' => 'Admin\DistrictController@update']);
    Route::get('district/destroy/{id}', ['as' => 'districts.destroy', 'uses' => 'Admin\DistrictController@destroy']);

    Route::get('city/list', ['as' => 'city.list', 'uses' => 'Admin\CityController@index']);
    Route::post('city/list', ['as' => 'city.list', 'uses' => 'Admin\CityController@getData']);
    Route::get('city/create', ['as' => 'city.create', 'uses' => 'Admin\CityController@create']);
    Route::post('city/save', ['as' => 'city.save', 'uses' => 'Admin\CityController@store']);
    Route::get('city/edit/{id}', ['as' => 'city.edit', 'uses' => 'Admin\CityController@edit']);
    Route::post('city/update/{id}', ['as' => 'city.update', 'uses' => 'Admin\CityController@update']);
    Route::get('city/destroy/{id}', ['as' => 'city.destroy', 'uses' => 'Admin\CityController@destroy']);


    Route::get('service/list', ['as' => 'service.list', 'uses' => 'Admin\OurServicesController@index']);
    Route::post('service/list', ['as' => 'service.list', 'uses' => 'Admin\OurServicesController@getData']);
    Route::get('service/create', ['as' => 'service.create', 'uses' => 'Admin\OurServicesController@create']);
    Route::post('service/save', ['as' => 'service.save', 'uses' => 'Admin\OurServicesController@store']);
    Route::get('service/edit/{id}', ['as' => 'service.edit', 'uses' => 'Admin\OurServicesController@edit']);
    Route::post('service/update/{id}', ['as' => 'service.update', 'uses' => 'Admin\OurServicesController@update']);
    Route::get('service/show/{id}', ['as' => 'service.show', 'uses' => 'Admin\OurServicesController@show']);
    Route::get('service/destroy/{id}', ['as' => 'service.destroy', 'uses' => 'Admin\OurServicesController@destroy']);

    Route::get('workflow/list', ['as' => 'workflow.list', 'uses' => 'Admin\WorkFlowController@index']);
    Route::post('workflow/list', ['as' => 'workflow.list', 'uses' => 'Admin\WorkFlowController@getData']);
    Route::get('workflow/create', ['as' => 'workflow.create', 'uses' => 'Admin\WorkFlowController@create']);
    Route::post('workflow/save', ['as' => 'workflow.save', 'uses' => 'Admin\WorkFlowController@store']);
    Route::get('workflow/edit/{id}', ['as' => 'workflow.edit', 'uses' => 'Admin\WorkFlowController@edit']);
    Route::post('workflow/update/{id}', ['as' => 'workflow.update', 'uses' => 'Admin\WorkFlowController@update']);
    Route::get('workflow/show/{id}', ['as' => 'workflow.show', 'uses' => 'Admin\WorkFlowController@show']);
    Route::get('workflow/destroy/{id}', ['as' => 'workflow.destroy', 'uses' => 'Admin\WorkFlowController@destroy']);

    Route::get('office/list', ['as' => 'office.list', 'uses' => 'Admin\OurOfficesController@index']);
    Route::post('office/list', ['as' => 'office.list', 'uses' => 'Admin\OurOfficesController@getData']);
    Route::get('office/create', ['as' => 'office.create', 'uses' => 'Admin\OurOfficesController@create']);
    Route::post('office/save', ['as' => 'office.save', 'uses' => 'Admin\OurOfficesController@store']);
    Route::get('office/edit/{id}', ['as' => 'office.edit', 'uses' => 'Admin\OurOfficesController@edit']);
    Route::post('office/update/{id}', ['as' => 'office.update', 'uses' => 'Admin\OurOfficesController@update']);
    Route::get('office/show/{id}', ['as' => 'office.show', 'uses' => 'Admin\OurOfficesController@show']);
    Route::get('office/destroy/{id}', ['as' => 'office.destroy', 'uses' => 'Admin\OurOfficesController@destroy']);
    Route::get('office/add/images', ['as' => 'office.images', 'uses' => 'Admin\OurOfficesController@addImages']);
    Route::post('office/add/images', ['as' => 'office.save.images', 'uses' => 'Admin\OurOfficesController@saveOfficeImages']);
    Route::get('office/images/show', ['as' => 'office.images.show', 'uses' => 'Admin\OurOfficesController@showOfficeImages']);
    Route::post('office/images/remove', ['as' => 'office.images.remove', 'uses' => 'Admin\OurOfficesController@removeOfficeImage']);

    Route::get('project/list', ['as' => 'project.list', 'uses' => 'Admin\ProjectsController@index']);
    Route::post('project/list', ['as' => 'project.list', 'uses' => 'Admin\ProjectsController@getData']);
    Route::get('project/create', ['as' => 'project.create', 'uses' => 'Admin\ProjectsController@create']);
    Route::post('project/save', ['as' => 'project.save', 'uses' => 'Admin\ProjectsController@store']);
    Route::get('project/edit/{id}', ['as' => 'project.edit', 'uses' => 'Admin\ProjectsController@edit']);
    Route::post('project/update/{id}', ['as' => 'project.update', 'uses' => 'Admin\ProjectsController@update']);
    Route::get('project/show/{id}', ['as' => 'project.show', 'uses' => 'Admin\ProjectsController@show']);
    Route::get('project/destroy/{id}', ['as' => 'project.destroy', 'uses' => 'Admin\ProjectsController@destroy']);

    Route::get('network/list', ['as' => 'network.list', 'uses' => 'Admin\NetworkController@index']);
    Route::post('network/list', ['as' => 'network.list', 'uses' => 'Admin\NetworkController@getData']);
    Route::get('network/create', ['as' => 'network.create', 'uses' => 'Admin\NetworkController@create']);
    Route::post('network/save', ['as' => 'network.save', 'uses' => 'Admin\NetworkController@store']);
    Route::get('network/edit/{id}', ['as' => 'network.edit', 'uses' => 'Admin\NetworkController@edit']);
    Route::post('network/update/{id}', ['as' => 'network.update', 'uses' => 'Admin\NetworkController@update']);
    Route::get('network/show/{id}', ['as' => 'network.show', 'uses' => 'Admin\NetworkController@show']);
    Route::get('network/destroy/{id}', ['as' => 'network.destroy', 'uses' => 'Admin\NetworkController@destroy']);

    Route::get('inquiry/list', ['as' => 'inquiry.list', 'uses' => 'Admin\InquiriesController@index']);
    Route::post('inquiry/list', ['as' => 'inquiry.list', 'uses' => 'Admin\InquiriesController@getData']);
    Route::get('inquiry/show/{id}', ['as' => 'inquiry.show', 'uses' => 'Admin\InquiriesController@show']);
    Route::get('inquiry/destroy/{id}', ['as' => 'inquiry.destroy', 'uses' => 'Admin\InquiriesController@destroy']);

    Route::get('news/list', ['as' => 'news.list', 'uses' => 'Admin\NewsController@index']);
    Route::post('news/list', ['as' => 'news.list', 'uses' => 'Admin\NewsController@getData']);
    Route::get('news/create', ['as' => 'news.create', 'uses' => 'Admin\NewsController@create']);
    Route::post('news/save', ['as' => 'news.save', 'uses' => 'Admin\NewsController@store']);
    Route::get('news/edit/{id}', ['as' => 'news.edit', 'uses' => 'Admin\NewsController@edit']);
    Route::post('news/update/{id}', ['as' => 'news.update', 'uses' => 'Admin\NewsController@update']);
    Route::get('news/show/{id}', ['as' => 'news.show', 'uses' => 'Admin\NewsController@show']);
    Route::get('news/destroy/{id}', ['as' => 'news.destroy', 'uses' => 'Admin\NewsController@destroy']);

    Route::get('current-opening/list', ['as' => 'current-opening.list', 'uses' => 'Admin\CurrentOpeningController@index']);
    Route::post('current-opening/list', ['as' => 'current-opening.list', 'uses' => 'Admin\CurrentOpeningController@getData']);
    Route::get('current-opening/create', ['as' => 'current-opening.create', 'uses' => 'Admin\CurrentOpeningController@create']);
    Route::post('current-opening/save', ['as' => 'current-opening.save', 'uses' => 'Admin\CurrentOpeningController@store']);
    Route::get('current-opening/edit/{id}', ['as' => 'current-opening.edit', 'uses' => 'Admin\CurrentOpeningController@edit']);
    Route::post('current-opening/update/{id}', ['as' => 'current-opening.update', 'uses' => 'Admin\CurrentOpeningController@update']);
    Route::get('current-opening/show/{id}', ['as' => 'current-opening.show', 'uses' => 'Admin\CurrentOpeningController@show']);
    Route::get('current-opening/destroy/{id}', ['as' => 'current-opening.destroy', 'uses' => 'Admin\CurrentOpeningController@destroy']);

    Route::get('career/list', ['as' => 'career.list', 'uses' => 'Admin\CareersController@index']);
    Route::post('career/list', ['as' => 'career.list', 'uses' => 'Admin\CareersController@getData']);
    Route::get('career/show/{id}', ['as' => 'career.show', 'uses' => 'Admin\CareersController@show']);
    Route::get('career/destroy/{id}', ['as' => 'career.destroy', 'uses' => 'Admin\CareersController@destroy']);
    Route::get('/resume/{file}', array('as' => 'career.download', 'uses' => 'Admin\CareersController@downloadResume'));

    Route::get('album/list', ['as' => 'albums.list', 'uses' => 'Admin\CareersController@index']);
    Route::get('album/add/images', ['as' => 'album.images', 'uses' => 'Admin\AlbumController@addImages']);
    Route::post('album/add/images', ['as' => 'album.save.images', 'uses' => 'Admin\AlbumController@saveImages']);
    //Route::get('album/images/show', ['as' => 'album.images.show', 'uses' => 'Admin\AlbumController@showImages']);
   // Route::post('album/images/remove', ['as' => 'album.images.remove', 'uses' => 'Admin\AlbumController@removeImage']);

    Route::get('config/list', ['as' => 'config.list', 'uses' => 'Admin\SiteConfigurationController@index']);
    Route::post('config/list', ['as' => 'config.list', 'uses' => 'Admin\SiteConfigurationController@getData']);
    Route::get('config/edit/{id}', ['as' => 'config.edit', 'uses' => 'Admin\SiteConfigurationController@edit']);
    Route::post('config/update/{id}', ['as' => 'config.update', 'uses' => 'Admin\SiteConfigurationController@update']);
    Route::get('config/show/{id}', ['as' => 'config.show', 'uses' => 'Admin\SiteConfigurationController@show']);

    Route::get('seo', ['as' => 'admin.seo', 'uses' => 'Admin\SEOManagementController@edit']);
    Route::post('seo/update/{id}', ['as' => 'admin.seo.update', 'uses' => 'Admin\SEOManagementController@update']);

    Route::post('change/status', ['as' => 'change.status', 'uses' => 'Controller@changeStatus']);
    Route::post('get/cities', ['as' => 'getcities', 'uses' => 'Admin\StateController@getCities']);
    Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);
});

Route::get('/{pageName}',array('as' => 'page-content', 'uses' => 'HomeController@getPage'));
