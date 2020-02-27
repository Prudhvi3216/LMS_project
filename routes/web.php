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

//Guest Routes
Route::get('/', 'MainController@index')->name('home');
Route::get('/home', 'MainController@index')->name('home');
Route::get('/course/{course_name}', 'MainController@frontend_curriculum');


Auth::routes();

Route::get('course', function(){
  return view('frontend/index');
});

//Backend routes
Route::group(['middleware'=>['auth','can:Admin_or_Inst']], function(){
  //Categories  
  Route::resource('/categories', 'Admin\CategoriesController');

  //Courses
  Route::resource('/courses', 'CourseController');
  Route::post('/get-course-info/{id}', 'InstructorController@get_course_data');

  //Curriculum routes
  Route::post('/add-section', 'InstructorController@add_sectiondata')->name('add-section');
  Route::post('/create-curriculum', 'InstructorController@create_curriculum')->name('create-curriculum');
  Route::post('/get-curriculum/{id}', 'InstructorController@get_curriculum')->name('get-curriculum');
  Route::post('/get-single-lecture/{id}', 'InstructorController@get_single_lecture');
  Route::post('/update-section-title/{id}', 'InstructorController@update_section_title');
  Route::post('/update-existing-lecture/{id}', 'InstructorController@update_existing_lecture')->name('update-lecture');
  Route::post('/delete-lecture/{id}', 'InstructorController@delete_existing_lecture')->name('delete-lecture');

  Route::get('/add-curriculum', 'VueController@curriculum')->name('add-curriculum');
  Route::post('/course-uploadfile', 'fileUploadController@upload_file')->name('course_fileupload');

  //Dashboard
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard-index');
  Route::get('/dashboard/categories_list', 'VueController@categories_list');
});

//Route::get('/home', 'HomeController@index')->name('home');
