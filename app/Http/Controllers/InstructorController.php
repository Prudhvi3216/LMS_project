<?php

namespace App\Http\Controllers;

use App\CurriculumSection;
use App\Course;
use Validator;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function create_curriculum(Request $request, $id){
        $payLoad = json_decode(request()->getContent(), true);

        $section_title = $payLoad['section_title'];
        $lectures_count = $payLoad['lectures_count'];
        $each_lecture = [];
        foreach($payLoad['lectures_data'] as $lecture_data_array){
            for($i=0;$i<=$lectures_count;$i++)
            {
                $each_lecture[$i] = $lecture_data_array[$i];
            }
        }
        foreach($each_lecture as $category => $lecture_content){
            
        }
        foreach($payLoad['lecture_files'] as $lecture_files){
            dd($lecture_files);
        }

        /*
        $rules = [
            'section_title' => 'required',
        ];
        $base_validator = Validator($payLoad, $rules);

        if($validator->passes()){
            return response()->json('Data Valid');
        }
        else{
            return response()->json($validator->errors()->all());
        }

        /*
        if($id){
            $curriculum_section = new CurriculumSection;
            $curriculum_section->course_id = $id;
            $curriculum_section->title = $request->title;
            $curriculum_section->sort_order = $request->sort_order;
            $curriculum_section->save();
        }
        */
    }

    public function get_curriculum($id){
        $curriculum = CurriculumSection::find($id);
        return response()->json($curriculum);
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
