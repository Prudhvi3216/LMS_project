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
            $data['sections'] = $course->sections;
            return view('frontend.pages.course')->with('data',$data);
        }
        else{
            return response()->json('Course not exist',200);
        }
    }
}
