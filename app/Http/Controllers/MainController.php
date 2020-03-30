<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Course;
use App\CurriculumSection;
use App\Instructor;
use App\CurriculumLecturesQuiz;
use App\Http\Resources\CourseInfo;

class MainController extends Controller
{
    //Home page data
    public function popular_courses(){
        //$categories = Category::Select('id', 'name', 'slug')->get();
        $db_courses = Course::Where('is_active',1)->get();
        if(count($db_courses)){
            $all_courses = [];
            foreach($db_courses as $course){
                $data['course_id'] = $course->id;
                $data['course_title'] = $course->course_title;
                $data['course_slug'] = $course->course_slug;
                $data['category'] = $course->category->name;
                $data['slug'] = $course->course_slug;
                $data['price'] = $course->price;
                $data['strike_out_price'] = $course->strike_out_price;
                $data['instructor'] = $course->instructor->last_name;
                $data['instructor_slug'] = $course->instructor->instructor_slug;
                array_push($all_courses,$data);
            }
        }    
        return response()->json($all_courses,200);
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
