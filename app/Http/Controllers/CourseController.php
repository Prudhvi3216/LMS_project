<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use App\Instructor;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //if(\Auth::user()->can('isInstructor')){
        $courses = Course::Where('is_active',1)->Select('id','course_title','course_slug','category_id','instructor_id')->get();
        return view('backend.courses.courses')->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.courses.CourseAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id'=> 'required|numeric',
            'instruction_level_id'=> 'required|numeric',
            'course_title' => 'required|string|min:3',
            'duration'=> 'numeric',
            'price'=> 'numeric',
            'strike_out_price'=> 'numeric',
            'overview'=> 'required|string',
            'is_active'=> 'required',
        ]);
        if($validatedData){
            $course = new Course;
            $instructor_id = \Auth::user()->instructor->id;
            $course->instructor_id = $instructor_id;
            $course->category_id = $request->category_id;
            $course->instruction_level_id = $request->instruction_level_id;
            $course->course_title = $request->course_title;
            $course->course_slug = Str::slug($request->course_title,'-');
            $course->keywords = $request->tags;
            $course->duration = $request->duration;
            $course->price = $request->price;
            $course->strike_out_price = $request->strike_out_price;
            $course->overview = $request->overview;
            $course->is_active = $request->is_active;
            $course->save();
            $inserted_id = $course->id;
            $message = 'New Course Created Successfully';
            return response()->json(['message'=> $message, 'type'=>'success', 'course_id' => $inserted_id]);
            //return redirect('courses')->with(['alert_type'=>'success', 'alert_message'=>'Category Added Successfully']);
        }
        else{
            return response()->json(['errors'=> $errors, 'type'=>'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $params = Course::find($id, ['id', 'name', 'slug']);
        return view('backend.courses.CoursesEdit')->with('params', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
