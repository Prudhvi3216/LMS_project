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
Route::get('/get-curriculum/{slug}', 'MainController@frontend_curriculum');
Route::get('/popular-courses', 'MainController@popular_courses'); //Need to change logic to popularity
Route::get('/get-courses', 'MainController@popular_courses');
Route::get('/get-courses/{category_name}', 'MainController@get_courses_of_category');
Route::post('/get-instructor-info/{instructor_slug}', 'MainController@instructor_info');
Route::get('/get-course-categories', 'MainController@categories_list');

//Authentication routes
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

//Admin API's
Route::get('/admin-courses-info', 'CourseController@index');
Route::get('/admin-categories-info', 'CategoriesController@index');
Route::get('/admin-instructors-info', 'AdminController@instructors_info');
Route::get('/admin/blogs', 'AdminController@blogs');

Route::get('/course-files','InstructorController@lecture_files');

//Instructor API's
Route::group(['prefix'=>'instructor', 'middleware'=>'auth:api'], function() {
  Route::resource('/courses', 'CourseController');
  Route::get('/instructor-courses', 'InstructorController@instructor_courses');
  Route::get('/view-profile', 'InstructorController@view_profile');
  Route::post('/update-profile', 'InstructorController@update_profile');

  //Course Routes
  Route::get('/get-course-data/{id}', 'InstructorController@get_course_data');
  Route::get('/course-curriculum/{id}', 'InstructorController@curriculum');
  Route::post('/upload-course-image', 'fileUploadController@upload_course_image');
  Route::post('/upload-course-video', 'fileUploadController@upload_course_video');
  Route::get('/get-course-media/{id}', 'InstructorController@get_course_media');

  //Curriculum Routes
  Route::post('/add-section', 'InstructorController@add_sectiondata')->name('add-section');
  Route::post('/create-curriculum', 'InstructorController@create_curriculum')->name('create-curriculum');
  Route::post('/get-curriculum/{id}', 'InstructorController@get_curriculum')->name('get-curriculum');
  Route::post('/get-single-lecture/{id}', 'InstructorController@get_single_lecture');
  Route::post('/update-section-title/{id}', 'InstructorController@update_section_title');
  Route::post('/update-existing-lecture/{id}', 'InstructorController@update_existing_lecture')->name('update-lecture');
  Route::post('/delete-lecture/{id}', 'InstructorController@delete_existing_lecture')->name('delete-lecture');
  Route::delete('/delete-lecture-file/{id}', 'fileUploadController@delete_lecture_file');

  Route::get('/add-curriculum', 'VueController@curriculum')->name('add-curriculum');
  Route::post('/course-uploadfile', 'fileUploadController@upload_file')->name('course_fileupload');

  //Test Routes

});

//Guest Gaurded API's
Route::middleware('auth:api')->group(function() {
  Route::post('/logout', 'AuthController@logout');
});

//User API's
Route::group(['prefix'=>'user', 'middleware'=>'auth:api'], function() {
  
    Route::get('/', 'AuthController@user');

    Route::get('/enroll-course/{course_id}', 'UserController@enroll_course');
    Route::get('/my-courses', 'UserController@my_courses');
    
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
