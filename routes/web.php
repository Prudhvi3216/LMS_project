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
  Route::post('/create-curriculum/{id}', 'InstructorController@create_curriculum')->name('create-curriculum');
  Route::post('/get-curriculum/{id}', 'InstructorController@get_curriculum')->name('get-curriculum');
  Route::get('/add-curriculum', 'VueController@curriculum')->name('add-curriculum');


  //Dashboard
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard-index');
  Route::get('/dashboard/categories_list', 'VueController@categories_list');
});

//Route::get('/home', 'HomeController@index')->name('home');
