<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function instructor(){
      return $this->belongsTo('App\Instructor');
    }
}
