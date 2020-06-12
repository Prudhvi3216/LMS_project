<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use App\Instructor;
use App\InstructionLevel;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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
        $db_courses = Course::Where('is_active',1)->get();
        if(count($db_courses)){
            $all_courses = [];
            foreach($db_courses as $course){
                $data['course_id'] = $course->id;
                $data['course_title'] = $course->course_title;
                $data['category'] = $course->category->name;
                $data['instructor'] = $course->instructor->last_name;
                $data['duration'] = $course->duration;
                $data['inst_level'] = $course->instruction_level->level; 
                array_push($all_courses,$data);
            }
            return response()->json(['req_type'=>'success','courses'=>$all_courses],200);
        }
        else{
            return response()->json(['req_type'=>'error','message'=>'No Courses found']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.courses.curriculum');
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
        if(Auth::check()){
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
                //$inserted_id = $course->id;
                $message = 'New Course Created Successfully';
                return response()->json($message,200);
                //return redirect('courses')->with(['alert_type'=>'success', 'alert_message'=>'Category Added Successfully']);
            }
            else{
                return response()->json(['errors'=> $errors, 'type'=>'error']);
            }
        }
        else{
            return response()->json('Unauthorized',400);
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
        return view('backend/courses/curriculum')->with('course_id',$id);
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
        
        $rules = [
            'course_title' => 'required|string|min:3',
            'category'=>'required|string',
            'instruction_level'=>'required|string',
            'duration'=> 'numeric',
            'price'=> 'numeric',
            'strike_out_price'=> 'numeric',
            'overview'=> 'required|string|min:6',
            'is_active'=> 'required',
            'keywords'=>'string'
        ];

        $validate = Validator::make($request->all(), $rules);

        if($validate->fails()){
            return response()->json([$validate->errors()->all()],422);
        }
        else{
            $category_id = Category::where('name', $request->category)->value('id');
            $instruction_level_id = InstructionLevel::where('level', $request->instruction_level)->value('id');

            $course = Course::find($id);
            $instructor_id = \Auth::user()->instructor->id;
            $course->category_id = $category_id;
            $course->instruction_level_id = $instruction_level_id;
            $course->course_title = $request->course_title;
            $course->course_slug = Str::slug($request->course_title,'-');
            $course->keywords = $request->keywords;
            $course->duration = $request->duration;
            $course->price = $request->price;
            $course->strike_out_price = $request->strike_out_price;
            $course->overview = $request->overview;
            $course->is_active = $request->is_active;
            $course->timestamps = false;
            $course->save();
            return response()->json('Course Updated Successfully',200);
        }    
       
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
