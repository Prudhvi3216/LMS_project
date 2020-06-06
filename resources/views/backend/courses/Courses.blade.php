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
<admin-courses-view :courses="{{ json_encode($courses) }}"></admin-courses-view>
@endsection
