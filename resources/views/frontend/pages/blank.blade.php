@extends('frontend.single_page')
@section('content')

<!-- heading banner -->
<header class="heading-banner text-white bgCover" style="background-image: url(https://placehold.it/1920x181);">
    <div class="container holder">
        <div class="align">
            <h1>Course Single</h1>
        </div>
    </div>
</header>

<!-- breadcrumb nav -->
<nav class="breadcrumb-nav">
    <div class="container">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="home.html">Home</a></li>
            <li><a href="contact.html">Course</a></li>
            <li class="active">{{ $data['course_title'] }}</li>
        </ol>
    </div>
</nav>

	

@endsection
