<?php

use Illuminate\Database\Seeder;
use App\Course;
use Illuminate\Support\Str;

class TestCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $is_exist = Course::all();

        if ($is_exist->count()) {
            $course = new Course();
            $course->instructor_id = 1;
            $course->category_id = 3;
            $course->instruction_level_id = 1;
            $course->course_title = 'Second Dummy course';
            $course->course_slug = Str::slug($course->course_title, '-');
            $course->is_active = 1;
            $course->save();
          }
    }
}
