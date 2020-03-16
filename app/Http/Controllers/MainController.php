<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\CurriculumSection;
use App\Instructor;
use App\CurriculumLecturesQuiz;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //Home page data
    public function index(){
        $categories = Category::Select('id', 'name', 'slug')->get();
        $courses = Course::Where('is_active',1)->Select('id','course_title','course_slug','price','strike_out_price','overview','category_id','instructor_id')->get();
        return view('frontend/pages/home')->with(['categories'=>$categories, 'courses'=>$courses]);
    }

    //Curriculum
    public function frontend_curriculum($course_slug){
        $course = Course::where('course_slug',$course_slug)->first();
        if($course && $course->is_active){
            $data['course_title'] = $course->course_title;
            $data['keywords'] = $course->keywords;
            $data['duration'] = $course->duration;
            $data['price'] = $course->price;
            $data['strike_out_price'] = $course->strike_out_price;
            $data['overview'] = $course->overview;
            $data['instructor'] = $course->instructor->last_name;
            $data['category'] = $course->category->name;
            $sections = $course->sections;
            $lectures = $sections->map->curriculum_lectures;
            return view('frontend.pages.course')->with(['curriculum'=>$sections,'info'=>$data]);
        }
        else{
            return response()->json('Course not exist',200);
        }
    }

    //Courses for a category
    public function get_courses_of_category($category_slug){
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            //Map method https://stackoverflow.com/questions/38412091/get-only-specific-attributes-with-from-laravel-collection
            $categories = Category::Select('id', 'name', 'slug')->get();
            $courses = $category->courses->map->only(['id','course_title','course_slug','price','strike_out_price','overview','category_id','instructor_id']);
            return view('frontend.pages.courses')->with(['categories'=>$categories,'courses'=>$courses]);
        }
        else{
            return response()->json('Category not exist',200);
        }
    }
}
