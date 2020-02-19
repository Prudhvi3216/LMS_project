<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\CourseFiles;

class fileUploadController extends Controller
{
    //Course files upload handler
    public function upload_file(Request $request){
        

            $file_validation = Validator::make($request->all(), [
                'file' => 'mimetypes:image/jpeg,image/png,video/avi,video/mpeg,video/quicktime,application/pdf',
            ]);

            if($file_validation->fails()){
                return response()->json(['errors'=>$file_validation->errors()->all()],400);
            }
            else
            {
                //Image file validation
                $image_validation = Validator::make($request->all(),[
                    'file' => 'max:2000', //single digit represents kb, image should be < 2MB
                ]);

                //Video file validation
                $video_validation = Validator::make($request->all(),[
                    'file' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
                    'file' => 'max:20000' //single digit represents kb, video should be < 20MB
                    
                ]);
                
                //Document file validation
                $doc_validation = Validator::make($request->all(),[
                    'file' => 'mimetypes:application/pdf',
                    'file' => 'max:4000' //single digit represents kb, document should be < 5MB
                ]);


                if($image_validation->fails() || $video_validation->fails() || $doc_validation->fails()){
                    return response()->json(['errors'=>$image_validation->errors()->all()],400);
                }
                else{
                    $lecture_file = $request->file('file');
                    $storage_path = 'curriculum_files/';

                    $file_title = $lecture_file->getClientOriginalName();
                    $file_size = $lecture_file->getSize();
                    $file_mimetype = $lecture_file->getMimeType();
                    $file_extension = $lecture_file->getClientOriginalExtension();

                    $file_name = rand().'-'.$file_title;
                    $lecture_file->move(public_path($storage_path), $file_name);

                    if(file_exists(public_path($storage_path).$file_name)){
                        $course_files = new CourseFiles;
                        $course_files->file_name = $file_name;
                        $course_files->file_title = $file_title;
                        $course_files->file_type = $file_mimetype;
                        $course_files->file_extension = $file_extension;
                        $course_files->file_size = $file_size;
                        $course_files->file_tag = 'test';
                        $course_files->uploader_id = \Auth::user()->instructor->id;
                        $course_files->processed = 1;
                        $course_files->save();
                       
                        if(!$course_files){
                            return response()->json(['errors'=>'Data not inserted, please try again!'],400);
                        }
                        else{
                            $info = 'Files Uploaded Successfully';
                            return response()->json($info,200);
                        }
                    }
                    else{
                        return response()->json(['errors'=>'Files not moved to storage'],400);
                    }  
                    
                }

            }     

        }
}
