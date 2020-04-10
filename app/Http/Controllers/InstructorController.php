<?php

namespace App\Http\Controllers;

//Models
use App\Course;
use App\CurriculumSection;
use App\CourseFiles;
use App\CurriculumLecturesQuiz;
use App\Instructor;

use Validator;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InstructorController extends Controller
{
    public function index(){
        
    }

    public function add_sectiondata(Request $request){

        $validate = $request->validate([
            'section_title' => 'required|string|min:3|max:40',
            'course_id' => 'required|numeric'    
        ]);

        if($validate){
            //Inserting Section data
            $curriculum_section = new CurriculumSection;
            $curriculum_section->course_id = $request->course_id;
            $curriculum_section->title = $request->section_title;
            $curriculum_section->save();
            
            if($curriculum_section){
                $inserted_id = $curriculum_section->section_id;
                $success_message = 'Section Added Successfully';
                return response()->json(['section_inserted_id'=>$inserted_id,'success'=>$success_message],200);
            }
            else{
                return response()->json('Section data not inserted',422);
            }
        }
    }

    //Adding new curriculum
    public function create_curriculum(Request $request){
        
        $validate = $request->validate([
            'section_id' => 'required|numeric',
            'lecture_title' => 'required|string|min:3|max:50',
            'lecture_description' => 'nullable|string',
            'lecture_contenttext' => 'nullable|string',
            'sort_order' => 'required|numeric',
            'media' => 'numeric',
            'media_type' => 'string',
        ]);

        if($validate){
                $curriculum_lectures_quiz = new CurriculumLecturesQuiz;
                $curriculum_lectures_quiz->title = $request->lecture_title;
                $curriculum_lectures_quiz->section_id = $request->section_id;
                $curriculum_lectures_quiz->description = $request->lecture_description;
                $curriculum_lectures_quiz->contenttext = $request->lecture_contenttext;
                $curriculum_lectures_quiz->media = $request->media;

                //Media Types
                if($request->media_type == 'application/pdf'){
                    $curriculum_lectures_quiz->media_type = 1;
                }
                if($request->media_type == 'video/avi' || $request->media_type == 'video/mpeg' || $request->media_type == 'video/quicktime' || $request->media_type == 'video/mp4'){
                    $curriculum_lectures_quiz->media_type = 0;
                }

                $curriculum_lectures_quiz->sort_order = $request->sort_order;
                //$curriculum_lectures_quiz->publish = $request->publish;
                //$curriculum_lectures_quiz->resources = $request->resources;
                $curriculum_lectures_quiz->save();
        }
        else{
            return response()->json('errors',$validate->errors()->all());
        }    
    }

    //Get Course name
    public function get_course_name($id){
        $course = Course::find($id);
        $course_name = $course->course_title;
        return response()->json(['course_name'=>$course_name],200); 
    }

    //Curriculum
    public function get_curriculum($id){
        $course = Course::find($id);
        $sections = $course->sections;
        $course_name = $course->course_title;
        $lectures = [];
        foreach ($sections as $section) {
            $data['section_id'] =  $section->section_id;
            $data['title'] = $section->title;
            $data['sort_order'] =  $section->sort_order;
            $data['lectures'] = $section->curriculum_lectures;
            array_push($lectures,$data);
        }
        return response()->json(['sections'=>$lectures,'course_name'=>$course_name],200); 
    }

    //Updating section title
    public function update_section_title(Request $request, $id){
        $rules = [
            'section_title' => 'required|string|min:3|max:40',
        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()){
            return response()->json($validate->errors()->all(), 422);
        }
        else{
            $curriculum_section = CurriculumSection::find($id);
            $curriculum_section->title = $request->section_title;
            $curriculum_section->save();
            return response()->json(['message'=>'Section title Successfully Updated'],200);
        }
        

    }

    //Deleting a section from course
    public function delete_existing_section($section_id){
        
    }

    //Deleting a lecture from section 
    public function delete_existing_lecture($lecture_id){
        $curriculum_lectures_quiz = CurriculumLecturesQuiz::find($lecture_id);
        $curriculum_lectures_quiz->delete(); //Can also use destroy method on model
        if($curriculum_lectures_quiz){
            $message = 'Record deleted Successfully';
            return response()->json($message,200);
        }
        else{
            dd('Record not Deleted'); 
        }
    }

    public function get_single_lecture($id){
        $curriculum_lectures_quiz = CurriculumLecturesQuiz::find($id);
        $data['lecture_title'] = $curriculum_lectures_quiz->title;
        $data['lecture_description'] = $curriculum_lectures_quiz->description;
        $data['lecture_contenttext'] = $curriculum_lectures_quiz->contenttext;
        return response()->json(['lecture'=>$data],200);
    }

    public function update_existing_lecture(Request $request, $lecture_id){
        
        $rules = [
            'lecture_title' => 'required|string|min:3|max:50',
            'lecture_description' => 'nullable|string',
            'lecture_contenttext' => 'nullable|string',
        ];

        $validate = Validator::make($request->all(),$rules);
        
        if($validate->fails()){
            return response()->json($validate->errors()->all(),422);
        }
        else{
            $curriculum_lectures_quiz = CurriculumLecturesQuiz::find($lecture_id);
            $curriculum_lectures_quiz->title = $request->lecture_title;
            $curriculum_lectures_quiz->description = $request->lecture_description;
            $curriculum_lectures_quiz->contenttext = $request->lecture_contenttext;
            $curriculum_lectures_quiz->save();
            return response()->json(['message'=>'Lecture Successfully Updated'],200);
        }    
       
    }

    //Get Course info based on Course ID
    public function get_course_data($id){
        $course = Course::find($id);
        $course_info['course_title'] = $course->course_title;
        $course_info['thumb_image'] = $course->thumb_image;
        $course_info['overview'] = $course->overview;
        $course_info['duration'] = $course->duration;
        $course_info['price'] = $course->price;
        $course_info['strike_out_price'] = $course->strike_out_price;
        $course_info['keywords'] = $course->keywords;
        $course_info['is_active'] = $course->is_active;
        $course_info['instruction_level'] = $course->instruction_level->level;
        $course_info['created_at'] = $course->created_at;
        $course_info['updated_at'] = $course->updated_at;
        $course_info['category'] = $course->category->name;
        $course_info['instructor'] =  $course->instructor->first_name;
        return response()->json(['course_info'=>$course_info],200);  
    }

    //Instructor Courses
    public function instructor_courses(){
        if(Auth::user()->can('isInstructor')){
            $instructor_id = Instructor::where('user_id',Auth::user()->id)->first()->id;
            $courses = Course::where('instructor_id',$instructor_id)->get();
            if(count($courses)){
                $inst_courses = [];
                foreach($courses as $course){
                    $data['id'] = $course->id;
                    $data['slug'] = $course->course_slug;
                    $data['course_title'] = $course->course_title;
                    $data['category'] = $course->category->name;
                    $data['duration'] = $course->duration; 
                    $data['inst_level'] = $course->instruction_level->level; 
                    array_push($inst_courses,$data);
                }
                return response()->json($inst_courses,200);
            }
            else{
                return response()->json('No Courses found');
            }
         }
    }

    //Instructor Profile view
    public function view_profile(){
        if(Auth::check() && Auth::user()->can('isInstructor')){    
            $instructor = Instructor::where('user_id',Auth::user()->id)->first();
            $inst['first_name'] = $instructor->first_name;
            $inst['last_name'] = $instructor->last_name;
            $inst['contact_email'] = $instructor->contact_email;
            $inst['telephone'] = $instructor->telephone;
            $inst['mobile'] = $instructor->mobile;
            $inst['paypal_id'] = $instructor->paypal_id;
            $inst['biography'] = $instructor->biography;
            $inst['instructor_image'] = $instructor->instructor_image;
            $inst['link_facebook'] = $instructor->link_facebook;
            $inst['link_twitter'] = $instructor->link_twitter;
            $inst['link_linkendin'] = $instructor->link_linkedin;
            $inst['link_google'] = $instructor->link_googleplus;
            return response()->json(['req_status'=>'success','info'=>$inst],200);
        }
        else{
            return response()->json(['req_status'=>'error','error_message'=>'Unauthorized'],401);   
        }
    }

    //Instructor Profile Update
    public function update_profile(Request $request){
        if(Auth::check() && Auth::user()->can('isInstructor')){
            $instructor = Instructor::where('user_id',Auth::user()->id)->first();
            $instructor->first_name = $request->first_name;
            $instructor->last_name = $request->last_name;
            $instructor->contact_email = $request->contact_email;
            $instructor->telephone = $request->telephone;
            $instructor->mobile =  $request->mobile;
            $instructor->biography =  $request->biography;
            $instructor->paypal_id =  $request->paypal_id;
            $instructor->link_facebook =  $request->link_facebook;
            $instructor->link_googleplus =  $request->link_googleplus;
            $instructor->link_twitter =  $request->link_twitter;
            $instructor->link_linkedin =  $request->link_linkedin;
            $instructor->save();
            return response()->json(['req_status'=>'success','message'=>'Profile Updated Successfully']);
        }
        else{
            return response()->json(['req_status'=>'error','error_message'=>'Unauthorized'],401);
        }
    }

    public function change_password(){
        if(Auth::user()->can('isInstructor')){
            $author_name = Auth::user()->first_name;
            dd($author_name);
         }
    }


}
