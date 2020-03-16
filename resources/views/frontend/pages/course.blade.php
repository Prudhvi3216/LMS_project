@extends('frontend.index')
@section('content')

<!-- heading banner -->
<header class="heading-banner text-white bgCover" style="background-image: url(http://placehold.it/1920x181);">
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
            <li class="active">Dummy</li>
        </ol>
    </div>
</nav>

<!-- two columns -->
<div id="two-columns" class="container">
    <div class="row">
        <!-- content -->
        <curriculum-view :curriculum="{{ json_encode($curriculum) }}" :info="{{ json_encode($info) }}"></curriculum-view>
    </div>
</div>

@endsection