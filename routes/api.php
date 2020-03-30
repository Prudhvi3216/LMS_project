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

//Guest routes
Route::post('/get-curriculum/{slug}', 'MainController@frontend_curriculum');
Route::get('/popular-courses', 'MainController@popular_courses');
Route::get('/get-courses', 'MainController@popular_courses');
Route::get('/get-courses/{category_name}', 'MainController@get_courses_of_category');

//Authentication routes
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/logout', 'AuthController@logout');


//User routes
Route::group(['prefix'=>'user', 'middleware'=>'auth:api'], function() {
    Route::get('my-courses', function () {
        return dd('My courses');
    });
  
    Route::get('edit-profile', function () {
      return dd('edit-profile');
    });
  
    Route::get('change-password', function () {
      return dd('Change Password');
    });
  
    Route::get('view-profile', function () {
      return dd('View Profile');
    });
  });
