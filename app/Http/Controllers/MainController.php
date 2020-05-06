<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
                $data['instructor_id'] = $course->instructor->id;
                $data['instructor'] = $course->instructor->last_name;
                $data['instructor_slug'] = $course->instructor->instructor_slug;
                $data['instructor_image'] = $course->instructor->instructor_image;
                array_push($all_courses,$data);
            }
        }    
        return response()->json($all_courses,200);
    }

    //Curriculum
    public function frontend_curriculum($course_slug){
        //Use get helper while using resourse collections, as get returns array of rows
        $course_id = Course::Select('id')->where('course_slug',$course_slug)->get();
        $course = Course::findOrFail($course_id);
        $data = CourseInfo::collection($course);
        return response()->json(['curriculum'=>$data],200);
    }

    //Courses for a category
    public function get_courses_of_category($category_slug){
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            //Map method https://stackoverflow.com/questions/38412091/get-only-specific-attributes-with-from-laravel-collection
            //$categories = Category::Select('id', 'name', 'slug')->get();
            $courses = $category->courses->map->only(['id','course_title','course_slug','price','strike_out_price','overview','category_id','instructor_id']);
            if($courses){
                return response()->json(['courses'=>$courses,'category'=>$category->name],200);
            }
            else{
                return response()->json('Courses Not Found',422);
            }
        }
        else{
            return response()->json('Category not exist',422);
        }
    }

    public function instructor_courses(Request $request){
        $inst_slug = $request->instructor_slug;
        $instructor_id = Instructor::where('instructor_slug',$inst_slug)->first()->id;
            $courses = Course::where('instructor_id',$instructor_id)->get();
            if(count($courses)){
                $inst_courses = [];
                foreach($courses as $course){
                    $data['id'] = $course->id;
                    $data['course_title'] = $course->course_title;
                    $data['course_slug'] = $course->course_slug;
                    $data['price'] = $course->price;
                    $data['strike_out_price'] = $course->strike_out_price;
                    $data['category'] = $course->category->name;
                    $data['duration'] = $course->duration; 
                    $data['instructor'] = $course->instructor->last_name; 
                    $data['instructor_slug'] = $course->instructor->instructor_slug; 
                    $data['instructor_image'] = $course->instructor->instructor_image;
                    $data['inst_level'] = $course->instruction_level->level; 
                    array_push($inst_courses,$data);
                }
                return response()->json($inst_courses,200);
            }
            else{
                return response()->json('No Courses found');
            }
    }

    public function instructor_info(Request $request){
            $inst_slug = $request->instructor_slug;
            $instructor = Instructor::where('instructor_slug',$inst_slug)->first();
            if($instructor){
                $inst['first_name'] = $instructor->first_name;
                $inst['last_name'] = $instructor->last_name;
                $inst['contact_email'] = $instructor->contact_email;
                $inst['instructor_image'] = $instructor->instructor_image;
                $inst['telephone'] = $instructor->telphone;
                $inst['mobile'] = $instructor->mobile;
                $inst['biography'] = $instructor->biography;
                $inst['link_facebook'] = $instructor->link_facebook;
                $inst['link_twitter'] = $instructor->link_twitter;
                $inst['link_linkendin'] = $instructor->link_linkendin;
                $inst['link_google'] = $instructor->link_googleplus;
                return response()->json(['req_type'=>'success', 'info'=>$inst],200);
            }
            else{
                $message = "Instructor Doesn't exist";
                return response()->json(['req_type'=>'error', 'message'=>$message],200);
            }
    }

    //Categories list for Course form and Frontend Menu
    public function categories_list(){
        $categories_list = Category::Select('id', 'name', 'slug', 'icon_class')->where('is_active',1)->get();
        return response()->json(['categories'=>$categories_list],200);
    }

}
