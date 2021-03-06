<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', array('as' => '/', 'uses' => 'HomeController@index'));
Route::post('/getcourse', array('as' => 'getcourses', 'uses' => 'HomeController@getCourses'));
Route::get('/course/{name}', array('as' => 'courses.show', 'uses' => 'CourseController@show'));
Route::get('/about-us', array('as' => 'about-us', 'uses' => 'HomeController@aboutUs'));
Route::get('/services', array('as' => 'services', 'uses' => 'HomeController@services'));
Route::get('/contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@contactUs'));
Route::post('/post/contact', array('as' => 'post-contact-us', 'uses' => 'HomeController@postContactUs'));
Route::post('/post/query', array('as' => 'post-query', 'uses' => 'HomeController@postQuery'));
Route::post('/post/enroll', array('as' => 'post-enroll', 'uses' => 'EnrollController@save'));
Route::get('/corporate-training', array('as' => 'corporate-training', 'uses' => 'EnrollController@corporateTraining'));
Route::post('/post-corporate-training', array('as' => 'post-corporate-training', 'uses' => 'EnrollController@postCorporateTraining'));
Route::get('/teach-with-us', array('as' => 'teach-with-us', 'uses' => 'EnrollController@teachWithUs'));
Route::post('/teach-with-us', array('as' => 'post-teach-with-us', 'uses' => 'EnrollController@postTeachWithUs'));
Route::get('/resume/{file}', array('as' => 'file.download', 'uses' => 'EnrollController@downloadResume'));
Route::get('/image/{folder}/{width}/{height}/{file}', array('as' => 'getimage', 'uses' => '\BaseController@getImage'));

Route::get('admin/sign-up', 'App\Controllers\Admin\AuthController@register');
Route::post('register', array('as' => 'admin.signup', 'uses' => 'App\Controllers\Admin\AuthController@postRegister'));
Route::post('login', array('as' => 'admin.login', 'uses' => 'App\Controllers\Admin\AuthController@postLogin'));
Route::get('admin/sign-in', array('as' => 'login', 'uses' => 'App\Controllers\Admin\AuthController@login'));
Route::post('file/temp/upload', array('as' => 'file.temp.upload', 'uses' => '\BaseController@uploadToTemp'));
Route::post('file/temp/remove', array('as' => 'file.temp.remove', 'uses' => '\BaseController@removeTempImage'));

Route::group(array('before' => 'authAdmin', 'prefix' => 'admin'), function() {
    Route::get('menu/list', ['as' => 'admin.menu.list', 'uses' => 'App\Controllers\Admin\CMSMenuController@index']);
    Route::post('menu/list', ['as' => 'admin.menu.list', 'uses' => 'App\Controllers\Admin\CMSMenuController@getData']);
    Route::get('menu/create', ['as' => 'admin.menu.create', 'uses' => 'App\Controllers\Admin\CMSMenuController@create']);
    Route::post('menu/save', ['as' => 'admin.menu.save', 'uses' => 'App\Controllers\Admin\CMSMenuController@store']);
    Route::get('menu/edit/{id}', ['as' => 'admin.menu.edit', 'uses' => 'App\Controllers\Admin\CMSMenuController@edit']);
    Route::post('menu/update/{id}', ['as' => 'admin.menu.update', 'uses' => 'App\Controllers\Admin\CMSMenuController@update']);
    Route::get('menu/show/{id}', ['as' => 'admin.menu.show', 'uses' => 'App\Controllers\Admin\CMSMenuController@show']);
    Route::get('menu/destroy/{id}', ['as' => 'admin.menu.destroy', 'uses' => 'App\Controllers\Admin\CMSMenuController@destroy']);

    Route::get('categories', array('as' => 'admin.categories', 'uses' => 'App\Controllers\Admin\CategoryController@index'));
    Route::post('categories', array('as' => 'admin.categories', 'uses' => 'App\Controllers\Admin\CategoryController@getData'));
    Route::get('categories/create', array('as' => 'admin.categories.create', 'uses' => 'App\Controllers\Admin\CategoryController@create'));
    Route::post('categories/save', array('as' => 'save-category', 'uses' => 'App\Controllers\Admin\CategoryController@store'));
    Route::get('categories/edit/{id}', array('as' => 'admin.categories.edit', 'uses' => 'App\Controllers\Admin\CategoryController@edit'));
    Route::post('categories/update/{id}', array('as' => 'admin.categories.update', 'uses' => 'App\Controllers\Admin\CategoryController@update'));
    Route::get('categories/delete/{id}', array('as' => 'admin.categories.delete', 'uses' => 'App\Controllers\Admin\CategoryController@destroy'));

    Route::get('courses', array('as' => 'admin.courses', 'uses' => 'App\Controllers\Admin\CourseController@index'));
    Route::post('courses', array('as' => 'admin.course.list', 'uses' => 'App\Controllers\Admin\CourseController@getData'));
    Route::get('courses/create', array('as' => 'admin.courses.create', 'uses' => 'App\Controllers\Admin\CourseController@create'));
    Route::post('courses/save', array('as' => 'admin.courses.save', 'uses' => 'App\Controllers\Admin\CourseController@store'));
    Route::get('courses/edit/{id}', array('as' => 'admin.courses.edit', 'uses' => 'App\Controllers\Admin\CourseController@edit'));
    Route::post('courses/update/{id}', array('as' => 'admin.courses.update', 'uses' => 'App\Controllers\Admin\CourseController@update'));
    Route::get('courses/delete/{id}', array('as' => 'admin.courses.delete', 'uses' => 'App\Controllers\Admin\CourseController@destroy'));
    Route::get('courses/show/{id}', array('as' => 'admin.courses.show', 'uses' => 'App\Controllers\Admin\CourseController@show'));

    Route::get('alumni', array('as' => 'admin.alumnies', 'uses' => 'App\Controllers\Admin\AlumniController@index'));
    Route::post('alumni', array('as' => 'admin.alumnies', 'uses' => 'App\Controllers\Admin\AlumniController@getData'));
    Route::get('alumni/create', array('as' => 'admin.alumnies.create', 'uses' => 'App\Controllers\Admin\AlumniController@create'));
    Route::post('alumni/save', array('as' => 'admin.alumnies.save', 'uses' => 'App\Controllers\Admin\AlumniController@store'));
    Route::get('alumni/edit/{id}', array('as' => 'admin.alumnies.edit', 'uses' => 'App\Controllers\Admin\AlumniController@edit'));
    Route::post('alumni/update/{id}', array('as' => 'admin.alumnies.update', 'uses' => 'App\Controllers\Admin\AlumniController@update'));
    Route::get('alumni/delete/{id}', array('as' => 'admin.alumnies.delete', 'uses' => 'App\Controllers\Admin\AlumniController@destroy'));
    Route::get('alumni/show/{id}', array('as' => 'admin.alumnies.show', 'uses' => 'App\Controllers\Admin\AlumniController@show'));

    Route::get('enrollment/', array('as' => 'admin.enroll', 'uses' => 'App\Controllers\Admin\EnrollController@index'));
    Route::post('enrollment/', array('as' => 'admin.enroll', 'uses' => 'App\Controllers\Admin\EnrollController@getData'));
    Route::get('enrollment/show/{id}', array('as' => 'admin.enroll.show', 'uses' => 'App\Controllers\Admin\EnrollController@show'));

    Route::get('corporatetraining/', array('as' => 'admin.corporatetraining', 'uses' => 'App\Controllers\Admin\CorporateTrainingController@index'));
    Route::post('corporatetraining/', array('as' => 'admin.corporatetraining', 'uses' => 'App\Controllers\Admin\CorporateTrainingController@getData'));
    Route::get('corporatetraining/show/{id}', array('as' => 'admin.corporatetraining.show', 'uses' => 'App\Controllers\Admin\CorporateTrainingController@show'));

    Route::get('teachwithus/', array('as' => 'admin.teachwithus', 'uses' => 'App\Controllers\Admin\TeachWithUsController@index'));
    Route::post('teachwithus/', array('as' => 'admin.teachwithus', 'uses' => 'App\Controllers\Admin\TeachWithUsController@getData'));
    Route::get('teachwithus/show/{id}', array('as' => 'admin.teachwithus.show', 'uses' => 'App\Controllers\Admin\TeachWithUsController@show'));

    Route::get('inquiry/list', ['as' => 'admin.inquiries.list', 'uses' => 'App\Controllers\Admin\ContactInquiryController@index']);
    Route::post('inquiry/list', ['as' => 'admin.inquiries.list', 'uses' => 'App\Controllers\Admin\ContactInquiryController@getData']);
    Route::get('inquiry/show/{id}', ['as' => 'admin.inquiry.show', 'uses' => 'App\Controllers\Admin\ContactInquiryController@show']);
    Route::get('inquiry/destroy/{id}', ['as' => 'admin.inquiry.destroy', 'uses' => 'App\Controllers\Admin\ContactInquiryController@destroy']);

   
    Route::get('logout', array('as' => 'admin.logout', 'uses' => 'App\Controllers\Admin\AuthController@logout'));
});
