@extends('backend.index')

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ route('dashboard-index') }}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Courses</li>
</ol>
@endsection

@section('content')
<h4>Courses</h4>
  @can('isInstructor')
    <a href="{{ route('courses.create') }}" class="btn btn-success mb-3">Add course</a>
  @endcan
  
  <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
    <th>ID</th>
    <th>Course</th>
    <th>Slug</th>
    <th>Category</th>
    <th>Instructor</th>
    <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($courses as $course)
      <tr>
      <td>{{ $course->id }}</td>
      <td>{{ $course->course_title }}</td>
      <td>{{ $course->course_slug }}</td>
      <td>{{ $course->category->name }}</td>
      <td>{{ $course->instructor->first_name }}</td>
      <td>
        @can('isInstructor')
        <div class="row">
          <div class="ml-2 mr-1">
              <a href="{{ route('courses.edit', $course->id) }}"><button class="btn btn-sm btn-outline-primary">Edit</button></a>
          </div>
          <div>
            <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button></a>
            </form>
          </div>
        </div>
        @endcan
      </td>
      </tr>
    @endforeach
  <tbody>
  </table>
@endsection
