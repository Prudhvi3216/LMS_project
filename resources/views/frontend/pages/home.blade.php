@extends('frontend.index')
@section('content')
<home-slider></home-slider>
<section class="popular-posts-block container">
    <header class="popular-posts-head">
        <h2 class="popular-head-heading">Most Popular Courses</h2>
    </header>
    <div class="row">
        @foreach($courses as $course)
            <course-card :course="{{ $course }}" instructor="{{ $course->instructor->first_name }}"></course-card>
        @endforeach
    </div>
</section>

<!--
<section class="popular-posts-block container">
    <header class="popular-posts-head">
        <h2 class="popular-head-heading">Most Popular Courses</h2>
    </header>
    <div class="row">
    
        <div class="slider popular-posts-slider">
            @foreach($courses as $course)
           
            <div class="col-xs-12 col-md-3">
            
                    <article class="popular-post">
                        <div class="aligncenter">
                            <img src="http://placehold.it/262x212" alt="image description">
                        </div>
                        <div>
                            <strong class="bg-primary text-white font-lato text-uppercase price-tag">{{ $course->price }}</strong>
                        </div>
                        <h3 class="post-heading"><a href="/course/{{ $course->course_slug }}">{{ $course->course_title }}</a></h3>
                        <div class="post-author">
                            <div class="alignleft rounded-circle no-shrink">
                                <img src="http://placehold.it/35x35" class="rounded-circle" alt="image description">
                            </div>
                            <h4 class="author-heading"><a href="instructor-single.html"></a>{{ $course->instructor->first_name }}</h4>
                        </div>
                        <footer class="post-foot gutter-reset">
                            <ul class="list-unstyled post-statuses-list">
                                <li>
                                    <a href="#">
                                        <span class="fas icn fa-users no-shrink"><span class="sr-only">users</span></span>
                                        <strong class="text fw-normal">98</strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fas icn no-shrink fa-comments"><span class="sr-only">comments</span></span>
                                        <strong class="text fw-normal">10</strong>
                                    </a>
                                </li>
                            </ul>
                            <ul class="star-rating list-unstyled">
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            </ul>
                        </footer>
                    </article>
            </div>
            
        
            @endforeach
        </div>
    </div>
</section>
-->    
@endsection