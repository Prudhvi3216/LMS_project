<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Instructor;
use App\Blog;

class AdminController extends Controller
{
    //Dashboard home page
    public function instructors_info(){
        $instructors = Instructor::all();
        $inst_data = [];
        foreach($instructors as $instructor) {
            $data['id'] = $instructor->id;
            $data['first_name'] = $instructor->first_name;
            $data['last_name'] = $instructor->last_name;
            $data['instructor_image'] = $instructor->instructor_image;
            $data['instructor_slug'] = $instructor->instructor_slug;
            $data['course_count'] = $instructor->courses->count();
            array_push($inst_data,$data);
        }
        return response()->json(['req_type'=>'success','instructors'=>$inst_data],200);
      }

      public function blogs(){
          $blog_posts = Blog::all();
          return response()->json(['blogs'=>$blog_posts],200);
      }

      //Create Instructor
      public function create_instructor(){

      }
}
