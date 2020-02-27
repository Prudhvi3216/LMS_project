<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumLecturesQuiz extends Model
{
    protected $table = 'curriculum_lectures_quiz';
    protected $primaryKey = 'lecture_quiz_id';
    public $timestamps = false;

    public function sections(){
        return $this->belongsTo('App\CurriculumSection');
    }
}
