<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumSection extends Model
{
    protected $table = 'curriculum_sections';
    protected $primaryKey = 'section_id';
    public $timestamps = false;
}
