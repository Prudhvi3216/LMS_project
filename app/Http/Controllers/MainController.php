<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //Home page data
    public function index(){
        $categories = Category::Select('id', 'name', 'slug')->get();
        $courses = Course::Where('is_active',1)->Select('id','course_title','course_slug','price','strike_out_price','overview','category_id','instructor_id')->get();
        return view('frontend/pages/home')->with(['categories'=>$categories, 'courses'=>$courses]);
    }
}
