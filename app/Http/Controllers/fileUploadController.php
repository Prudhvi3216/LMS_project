<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Course;
use App\CourseFiles;


class fileUploadController extends Controller
{
    //Course files upload handler
    public function upload_file(Request $request){
            $file_validation = Validator::make($request->all(), [
                'file' => 'mimetypes:image/jpeg,image/png,video/avi,video/mpeg,video/quicktime,video/mp4,application/pdf'
            ]);

            if($file_validation->fails()){
                return response()->json(['error'=>$file_validation->errors()->all()],422);
            }
            else
            {   
                $lecture_file = $request->file('file');
                $file_mimetype = $lecture_file->getMimeType();
                if($file_mimetype == 'image/jpeg' || $file_mimetype == 'image/png'){
                    //Image validation
                    $image_validation = Validator::make($request->all(),[
                        'file' => 'max:2000' //single digit represents kb, image should be < 2MB
                    ]);
                    if($image_validation->fails()){
                        return response()->json(['error'=>$image_validation->errors()->all()],422);
                    }
                    else{
                        $file_inserted_at = $this->save_uploaded_file($lecture_file);
                       if($file_inserted_at){
                            $file_data = [];
                            $file = CourseFiles::find($file_inserted_at);
                            $file_data['id'] = $file->id;
                            $file_data['file_title'] = $file->file_title;
                            $file_data['file_size'] = $file->file_size;
                            $file_data['file_type'] = $file->file_type;
                            return response()->json(['success'=>'File Uploaded Successfully','file_data'=>$file_data],200);
                       }
                       else{
                            return response()->json(['error'=>'Failed to Upload'],422);
                       }
                    }
                }
                elseif($file_mimetype == 'video/avi' || $file_mimetype == 'video/mpeg' || $file_mimetype == 'video/quicktime' || $file_mimetype == 'video/mp4'){
                    //Video validation
                    $video_validation = Validator::make($request->all(),[
                        'file' => 'max:20000' //single digit represents kb, video should be < 20MB
                    ]);
                    if($video_validation->fails()){
                        return response()->json(['error'=>$video_validation->errors()->all()],422);
                    }
                    else{
                        $file_inserted_at = $this->save_uploaded_file($lecture_file);
                        if($file_inserted_at){
                            $file_data = [];
                            $file = CourseFiles::find($file_inserted_at);
                            $file_data['id'] = $file->id;
                            $file_data['file_title'] = $file->file_title;
                            $file_data['file_size'] = $file->file_size;
                            $file_data['file_type'] = $file->file_type;
                            return response()->json(['success'=>'File Uploaded Successfully','file_data'=>$file_data],200);
                        }
                        else{
                             return response()->json(['error'=>'Failed to Upload'],422);
                        }
                    }
                }
                elseif($file_mimetype == 'application/pdf'){
                    //Video validation
                    $doc_validation = Validator::make($request->all(),[
                        'file' => 'max:5000' //single digit represents kb, document should be < 5MB
                    ]);
                    if($doc_validation->fails()){
                        return response()->json(['error'=>$doc_validation->errors()->all()],422);
                    }
                    else{
                        $file_inserted_at = $this->save_uploaded_file($lecture_file);
                        if($file_inserted_at){
                            $file_data = [];
                            $file = CourseFiles::find($file_inserted_at);
                            $file_data['id'] = $file->id;
                            $file_data['file_title'] = $file->file_title;
                            $file_data['file_size'] = $file->file_size;
                            $file_data['file_type'] = $file->file_type;
                            return response()->json(['success'=>'File Uploaded Successfully','file_data'=>$file_data],200);
                        }
                        else{
                             return response()->json(['error'=>'Failed to Upload'],422);
                        }
                    }
                }
                else{
                    return response()->json(['error'=>'Allowed only image/jpeg, image/png, video/avi, video/mpeg, video/quicktime, application/pdf file types'],422);
                }
            
            }
            //Main validation else end

        }

        public function save_uploaded_file($lecture_file){
            $storage_path = 'curriculum_files/';
            $file_title = $lecture_file->getClientOriginalName();
            $file_size = $lecture_file->getSize();
            $file_mimetype = $lecture_file->getMimeType();
            $file_extension = $lecture_file->getClientOriginalExtension();

            $file_name = rand().'-'.$file_title;
            Storage::put($storage_path.$file_name, file_get_contents($lecture_file));
            //$lecture_file->move(public_path($storage_path), $file_name);

            //if(file_exists(public_path($storage_path).$file_name)){
             if(Storage::exists($storage_path.$file_name)){   
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
                    return false;
                }
                else{
                    return $course_files->id;
                }
            } 
        }

        //Delete Lecture File
        public function delete_lecture_file($id){
            $storage_path = 'curriculum_files/';
            $file = CourseFiles::find($id);
            if($file){
                $file_name = $file->file_name;
                $file_database_clear = $file->delete();
                if($file_database_clear){
                    $file_deleted = Storage::delete($storage_path.$file_name);
                    if($file_deleted){
                        return response()->json('File Deleted Successfully',200);
                    }
                    else{
                        return response()->json('File not found in the directory',422);
                    }
                }
                else{
                    return response()->json('Unable to delete file record',422);
                }
            }
            else{
                return response()->json('No file record',422);
            }
        }

        //Course Image upload
        public function upload_course_image(Request $request){

            $file_validation = Validator::make($request->all(), [
                'course_id' => 'numeric',
                'image_file' => 'mimetypes:image/jpeg,image/png',
            ]);

            if($file_validation->fails()){
                return response()->json([$file_validation->errors()->all()],422);
            }
            else{                
                $file_path = Storage::disk('public')->put('/course_images', $request->image_file);
                if($file_path){
                    $course_id = $request->course_id;
                    $course = Course::find($course_id);
                    $course->course_image = $file_path;
                    $course->save();
                    return response()->json('File Uploaded and Data Inserted Successfully',200);
                }
                else{
                    return response()->json('File Not Uploaded',422);
                }   
                
            }
        }

        //Course Thumbnail upload
        public function upload_course_thumbnail(Request $request){

            $file_validation = Validator::make($request->all(), [
                'course_id' => 'numeric',
                'thumbnail_file' => 'mimetypes:image/jpeg,image/png',
            ]);

            if($file_validation->fails()){
                return response()->json([$file_validation->errors()->all()],422);
            }
            else{                
                $file_path = Storage::disk('public')->put('/course_thumbnails', $request->thumbnail_file);
                if($file_path){
                    $course_id = $request->course_id;
                    $course = Course::find($course_id);
                    $course->thumb_image = $file_path;
                    $course->save();
                    return response()->json('File Uploaded and Data Inserted Successfully',200);
                }
                else{
                    return response()->json('File Not Uploaded',422);
                }   
                
            }
        }


        //Upload Course Promo Video
        public function upload_course_promo(Request $request){
            $file_validation = Validator::make($request->all(), [
                'course_id' => 'numeric',
                'promo_file' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            ]);

            if($file_validation->fails()){
                return response()->json([$file_validation->errors()->all()],422);
            }
            else{
                $file_path = Storage::disk('public')->put('/course_promo_videos', $request->promo_file);
                if($file_path){
                    $course_id = $request->course_id;
                    $course = Course::find($course_id);
                    $course->course_video = $file_path;
                    $course->save();
                    return response()->json('File Uploaded and Data Inserted Successfully',200);
                }
                else{
                    return response()->json('File Not Uploaded',422);
                }   
            }
        }

        //Delete Course Thumbnail
        public function delete_course_thumbnail($course_id){
            $storage_path = '';
            $course = Course::find($course_id);
            if($course){
                $file_name = $course->thumb_image;
                if($file_name){
                    $course->thumb_image = '';
                    $course->save();
                    $file_deleted = Storage::disk('public')->delete($file_name);
                    if($file_deleted){
                        return response()->json('File Deleted Successfully',200);
                    }
                    else{
                        return response()->json('Unable to delete file from GCS, please check!',422);
                    }
                    
                }
                else{
                    return response()->json('Thumbnail Image Path Not Found',422);
                }

            }
            else{
                return response()->json('Course not exits',422);
            }
        }


        //Delete Course Thumbnail
        public function delete_course_image($course_id){
            $storage_path = '';
            $course = Course::find($course_id);
            if($course){
                $file_name = $course->course_image;
                if($file_name){
                    $course->course_image = '';
                    $course->save();
                    $file_deleted = Storage::disk('public')->delete($file_name);
                    if($file_deleted){
                        return response()->json('File Deleted Successfully',200);
                    }
                    else{
                        return response()->json('Unable to delete file from GCS, please check!',422);
                    }
                    
                }
                else{
                    return response()->json('Thumbnail Image Path Not Found',422);
                }

            }
            else{
                return response()->json('Course not exits',422);
            }
        }


        //Delete Course Thumbnail
        public function delete_course_promo($course_id){
            $storage_path = '';
            $course = Course::find($course_id);
            if($course){
                $file_name = $course->course_video;
                if($file_name){
                    $course->course_video = '';
                    $course->save();
                    $file_deleted = Storage::disk('public')->delete($file_name);
                    if($file_deleted){
                        return response()->json('File Deleted Successfully',200);
                    }
                    else{
                        return response()->json('Unable to delete file from GCS, please check!',422);
                    }
                    
                }
                else{
                    return response()->json('Thumbnail Image Path Not Found',422);
                }

            }
            else{
                return response()->json('Course not exits',422);
            }
        }
}