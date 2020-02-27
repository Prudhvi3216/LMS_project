<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function instructor(){
      return $this->belongsTo('App\Instructor');
    }

    public function sections(){
      return $this->hasMany('App\CurriculumSection', 'course_id');
    }

    public function instruction_level(){
      return $this->belongsTo('App\InstructionLevel');
    }
}
