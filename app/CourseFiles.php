<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFiles extends Model
{
    protected $table = 'course_files';
    public $timestamps = false;
    
    public function lecture(){
        return $this->belongsTo('App\CurriculumLecturesQuiz', 'media');
    }
}
