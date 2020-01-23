@extends('backend.index')
@section('content')
<h4>Add Course</h4>
<div class="container"> 
@can('isInstructor')
    <add-course></add-course>
    <!--<add-course-info></add-course-info>-->
@endcan
</div>
@endsection