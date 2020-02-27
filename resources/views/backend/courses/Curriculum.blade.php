@extends('backend.index')

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ route('dashboard-index') }}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Curriculum</li>
</ol>
@endsection

@section('content')
<div class="row">

    <div class="col-md-8">
    <!--Curriculum Section-->
        <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">@if($course_id ?? '')Course Info @else Add Course @endif</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">@if($course_id ?? '')Course Image @else Add Course Image @endif</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">@if($course_id ?? '')Course Curriculum @else Add Course Curriculum @endif</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container m-2">
                @if($course_id ?? '')
                <course-handler :course_id="{{ $course_id }}"></course-handler>
                @else
                <course-handler></course-handler>
                @endif
            </div>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container m-2">
              <!--
                <vue-dropzone 
                    id="drop2" 
                    refs="dropzone" 
                    :options="dropOptions" 
                ></vue-dropzone>
                -->
            </div>
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="container m-2">
                @if($course_id ?? '')
                  <curriculum-section :course_id="{{ $course_id}}"></curriculum-section>
                @else
                  <curriculum-section></curriculum-section>
                @endif
            </div>
          </div>
        </div>
      <!--Curriculum Section-->

    </div>
</div>    
@endsection