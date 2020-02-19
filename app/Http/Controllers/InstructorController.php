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
                $alert_type = 'success';
                $alert_message = 'Section Added Successfully';
                return response()->json(['section_inserted_id'=>$inserted_id,'alert_type'=>$alert_type, 'alert_message'=>$alert_message],200);
            }
            else{
                $alert_type = 'error';
                $alert_message = 'Section data not inserted';
                return response()->json(['alert_type'=>$alert_type, 'alert_message'=>$alert_message],200);
            }
        }
    }

    public function create_curriculum(Request $request){
        
        $validate = $request->validate([
            'section_id' => 'required|numeric',
            'lecture_title' => 'required|string|min:3|max:50',
            'lecture_description' => 'nullable|string',
            'lecture_contenttext' => 'nullable|string',
            'sort_order' => 'required|numeric',
        ]);

        if($validate){
            $curriculum_lectures_quiz = CurriculumSection::find($request->section_id)->curriculum_lectures;
            if($curriculum_lectures_quiz->count()){
                dd('Lectures exist in the given section - '.$request->section_id);
            }
            else{
                $curriculum_lectures_quiz = new CurriculumLecturesQuiz;
                $curriculum_lectures_quiz->title = $request->lecture_title;
                $curriculum_lectures_quiz->section_id = $request->section_id;
                $curriculum_lectures_quiz->description = $request->lecture_description;
                $curriculum_lectures_quiz->contenttext = $request->lecture_contenttext;
                //$curriculum_lectures_quiz->media = $request->media;
                //$curriculum_lectures_quiz->media_type = $request->media_type;
                $curriculum_lectures_quiz->sort_order = $request->sort_order;
                //$curriculum_lectures_quiz->publish = $request->publish;
                //$curriculum_lectures_quiz->resources = $request->resources;
                $curriculum_lectures_quiz->save();
            }
            
        }
        else{
            return response()->json('errors',$validate->errors()->all());
        }    
    }

    public function get_curriculum($id){
        $curriculum = CurriculumSection::where('course_id',$id)->first();
        $lectures = $curriculum->curriculum_lectures();
        dd($lectures);        
    }

    //From Ulearn
    public function getcurriculumArray($id='', $course_slug='')
    {
        $lectures = \DB::table('curriculum_sections')
              ->join('curriculum_lectures_quiz', 'curriculum_lectures_quiz.section_id', '=', 'curriculum_sections.section_id')
              ->leftJoin('course_videos', 'course_videos.id', '=', 'curriculum_lectures_quiz.media')
              ->leftJoin('course_files', 'course_files.id', '=', 'curriculum_lectures_quiz.media')
              ->select('curriculum_sections.section_id',
                'curriculum_lectures_quiz.lecture_quiz_id',
                'curriculum_sections.title as s_title', 
                'curriculum_lectures_quiz.title as l_title')
              ->where('curriculum_sections.course_id', '=', $id)
              ->where("curriculum_lectures_quiz.publish",'=','1')
              ->orderBy('curriculum_sections.sort_order', 'asc')
              ->orderBy('curriculum_lectures_quiz.sort_order', 'asc')
              ->get()->toArray();
        

        $lectures_array = array();
        $sections_array = array();
        $s_number = $l_number = 0;
        foreach ($lectures as $lecture) {
            $l_number++;
            if(!in_array($lecture->section_id, $sections_array))
            {
                $s_number++;
                $section['section_id'] = $lecture->section_id;
                $section['lecture_quiz_id'] = $lecture->lecture_quiz_id;
                $section['s_title'] = $lecture->s_title;
                $section['l_title'] = $lecture->l_title;
                $section['number'] = $s_number;
                $section['is_section'] = true;

                array_push($lectures_array, $section);    
            } 

            array_push($sections_array, $lecture->section_id);

            $lecture->is_section = false;
            $lecture->number = $l_number;
            $lecture->lecture_quiz_id = $lecture->lecture_quiz_id;
            
            $lecture->url = SiteHelpers::encrypt_decrypt($lecture->lecture_quiz_id);
            array_push($lectures_array, (array) $lecture);
        }
        $return['sections'] = $lectures_array;
        
        return $return;
    }
}
