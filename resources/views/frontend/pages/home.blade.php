@extends('frontend.index')
@section('content')
<section class="popular-posts-block container">
    <header class="popular-posts-head">
        <h2 class="popular-head-heading">Most Popular Courses</h2>
    </header>
    <div class="row">
        <!-- popular posts slider -->
        <div class="slider popular-posts-slider">
            @foreach($courses as $course)
                <course-card :course="{{ $course }}" instructor="{{ $course->instructor->first_name }}"></course-card>
            @endforeach
        </div>
    </div>
</section>    
@endsection