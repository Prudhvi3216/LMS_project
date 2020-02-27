<?php

namespace App\Http\Controllers;

//Models
use App\Course;
use App\CurriculumSection;
use App\CourseFiles;
use App\CurriculumLecturesQuiz;

use Validator;

use Illuminate\Http\Request;

class InstructorController extends Controller
{

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

}
