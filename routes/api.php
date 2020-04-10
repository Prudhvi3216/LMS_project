<?php

use Illuminate\Http\Request;

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


//Guest API's to MainController
Route::post('/get-curriculum/{slug}', 'MainController@frontend_curriculum');
Route::get('/popular-courses', 'MainController@popular_courses'); //Need to change logic to popularity
Route::get('/get-courses', 'MainController@popular_courses');
Route::get('/get-courses/{category_name}', 'MainController@get_courses_of_category');
Route::post('/get-instructor-info/{instructor_slug}', 'MainController@instructor_info');


//User routes
Route::group(['prefix'=>'instructor', 'middleware'=>'auth:api'], function() {
  Route::resource('/courses', 'CourseController');
  Route::get('/view-profile', 'InstructorController@view_profile');
  Route::post('/update-profile', 'InstructorController@update_profile');
  Route::post('/get-course-data/{id}', 'InstructorController@get_course_data');
});


//Admin API's
Route::get('/admin-courses-info', 'CourseController@index');
Route::get('/admin-categories-info', 'CategoriesController@index');
Route::get('/admin-instructors-info', 'DashboardController@instructors_info');


//Authentication routes
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

//Instructor API's
Route::middleware('auth:api')->group(function() {
  Route::post('/get-instructor-courses/{instructor_slug}', 'InstructorController@instructor_courses');
  Route::post('/logout', 'AuthController@logout');
});


//User routes
Route::group(['prefix'=>'user', 'middleware'=>'auth:api'], function() {
  
    Route::get('/', 'AuthController@user');

    Route::get('my-courses', function () {
        return dd('My courses');
    });
    
    Route::get('view-profile', function () {
      return dd('View Profile');
    });

    Route::get('edit-profile', function () {
      return dd('edit-profile');
    });
  
    Route::get('change-password', function () {
      return dd('Change Password');
    });
    
  });
