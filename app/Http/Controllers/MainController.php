<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\CurriculumSection;
use App\Instructor;
use App\CurriculumLecturesQuiz;
use App\Http\Resources\CourseInfo;


use Illuminate\Http\Request;

class MainController extends Controller
{
    //Home page data
    public function popular_courses(){
        //$categories = Category::Select('id', 'name', 'slug')->get();
        $courses = Course::Where('is_active',1)->Select('id','course_title','course_slug','price','strike_out_price','overview','category_id','instructor_id')->get();
        return response()->json(['courses'=>$courses],200);
    }

    //Curriculum
    public function frontend_curriculum($course_slug){
        //Use get helper while using resourse collections, as get returns array of rows
        $course = Course::where('course_slug',$course_slug)->get();
        if($course){
            $data = CourseInfo::collection($course);
            return response()->json($data,200);
        }
        else{
            return response()->json('Course not found');
        }
    }

    //Courses for a category
    public function get_courses_of_category($category_slug){
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            //Map method https://stackoverflow.com/questions/38412091/get-only-specific-attributes-with-from-laravel-collection
            //$categories = Category::Select('id', 'name', 'slug')->get();
            $courses = $category->courses->map->only(['id','course_title','course_slug','price','strike_out_price','overview','category_id','instructor_id']);
            return response()->json($courses,200);
            //return view('frontend.pages.courses')->with(['categories'=>$categories,'courses'=>$courses]);
        }
        else{
            return response()->json('Category not exist',200);
        }
    }
}
