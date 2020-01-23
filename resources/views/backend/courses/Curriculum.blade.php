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
        <add-course-info></add-course-info>
    </div>
</div>    
@endsection