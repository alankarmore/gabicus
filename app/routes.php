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

Route::get('/',array('as' => '/','uses' => 'HomeController@index'));
Route::get('/course/{name}',array('as' => 'courses.show','uses' => 'CourseController@show'));
Route::get('/about-us',array('as' => 'about-us','uses' => 'HomeController@aboutUs'));
Route::get('/services',array('as' => 'services','uses' => 'HomeController@services'));
Route::get('/contact-us',array('as' => 'contact-us','uses' => 'HomeController@contactUs'));
Route::post('/post/contact',array('as' => 'post-contact-us','uses' => 'HomeController@postContactUs'));
Route::post('/post/query',array('as' => 'post-query','uses' => 'HomeController@postQuery'));
Route::post('/post/enroll',array('as' => 'post-enroll','uses' => 'EnrollController@save'));
Route::get('/corporate-training',array('as' => 'corporate-training','uses' => 'EnrollController@corporateTraining'));
Route::post('/post-corporate-training',array('as' => 'post-corporate-training','uses' => 'EnrollController@postCorporateTraining'));
Route::get('/teach-with-us',array('as' => 'teach-with-us','uses' => 'EnrollController@teachWithUs'));
Route::post('/teach-with-us',array('as' => 'post-teach-with-us','uses' => 'EnrollController@postTeachWithUs'));
Route::get('/resume/{file}',array('as' => 'file.download','uses' => 'EnrollController@downloadResume'));

Route::get('sign-up','App\Controllers\Admin\AuthController@register');
Route::post('register',array('as' => 'admin.signup','uses' => 'App\Controllers\Admin\AuthController@postRegister'));
Route::post('login',array('as' => 'admin.login','uses' => 'App\Controllers\Admin\AuthController@postLogin'));
Route::get('sign-in',array('as' => 'login', 'uses' => 'App\Controllers\Admin\AuthController@login'));

Route::group(array('before' => 'authAdmin') , function() {
   Route::get('categories',array('as' => 'admin.categories','uses' => 'App\Controllers\Admin\CategoryController@index')); 
   Route::get('categories/create',array('as' => 'admin.categories.create','uses' => 'App\Controllers\Admin\CategoryController@create')); 
   Route::post('categories/save',array('as' => 'save-category','uses' => 'App\Controllers\Admin\CategoryController@store')); 
   Route::get('categories/edit/{id}',array('as' => 'admin.categories.edit','uses' => 'App\Controllers\Admin\CategoryController@edit')); 
   Route::post('categories/update/{id}',array('as' => 'admin.categories.update','uses' => 'App\Controllers\Admin\CategoryController@update')); 
   Route::get('categories/delete/{id}',array('as' => 'admin.categories.delete','uses' => 'App\Controllers\Admin\CategoryController@destroy')); 
   
   Route::get('courses',array('as' => 'admin.courses','uses' => 'App\Controllers\Admin\CourseController@index')); 
   Route::get('courses/create',array('as' => 'admin.courses.create','uses' => 'App\Controllers\Admin\CourseController@create')); 
   Route::post('courses/save',array('as' => 'admin.courses.save','uses' => 'App\Controllers\Admin\CourseController@store'));  
   Route::get('courses/edit/{id}',array('as' => 'admin.courses.edit','uses' => 'App\Controllers\Admin\CourseController@edit')); 
   Route::post('courses/update/{id}',array('as' => 'admin.courses.update','uses' => 'App\Controllers\Admin\CourseController@update')); 
   Route::get('courses/delete/{id}',array('as' => 'admin.courses.delete','uses' => 'App\Controllers\Admin\CourseController@destroy')); 
   Route::get('courses/show/{id}',array('as' => 'admin.courses.show','uses' => 'App\Controllers\Admin\CourseController@show')); 

   Route::get('alumni',array('as' => 'admin.alumnies','uses' => 'App\Controllers\Admin\AlumniController@index')); 
   Route::get('alumni/create',array('as' => 'admin.alumnies.create','uses' => 'App\Controllers\Admin\AlumniController@create')); 
   Route::post('alumni/save',array('as' => 'admin.alumnies.save','uses' => 'App\Controllers\Admin\AlumniController@store'));  
   Route::get('alumni/edit/{id}',array('as' => 'admin.alumnies.edit','uses' => 'App\Controllers\Admin\AlumniController@edit')); 
   Route::post('alumni/update/{id}',array('as' => 'admin.alumnies.update','uses' => 'App\Controllers\Admin\AlumniController@update')); 
   Route::get('alumni/delete/{id}',array('as' => 'admin.alumnies.delete','uses' => 'App\Controllers\Admin\AlumniController@destroy')); 
   Route::get('alumni/show/{id}',array('as' => 'admin.alumnies.show','uses' => 'App\Controllers\Admin\AlumniController@show')); 


   Route::get('logout',array('as' => 'admin.logout','uses' => 'App\Controllers\Admin\AuthController@logout')); 
});
