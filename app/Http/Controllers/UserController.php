<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\CourseTaken;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function enroll_course($course_id){
        if(Auth::check()){
            $user = Auth::user();
            $course = Course::findOrFail($course_id);
            $already_enrolled = $user->enrolled_courses()->where('course_id',$course_id)->exists();
            if($already_enrolled){
                return response()->json(['message'=>'Course already Enrolled'],422);
            }
            else{
                if($course->price == 0){
                    $course_enroll = new CourseTaken;
                    $course_enroll->user_id = $user->id;
                    $course_enroll->course_id = $course->id;
                    $course_enroll->save();
                    return response('Course Enrolled Successfully');
                }
                else{
                    return response('Course is Not Free');
                }
            }
        }
        else{
            return response()->json('Not Loggedin',401);
        }
    }

    public function my_courses(){
        if(Auth::check()){
            $enrolled_courses = Auth::user()->enrolled_courses;
            $data = [];
            foreach ($enrolled_courses as $single_course) {
                $course_id = $single_course->course_id;
                $courses = Course::find($course_id);
                array_push($data, $courses);
            }
            return response()->json(['courses'=>$data],200);
        }
    }
}
