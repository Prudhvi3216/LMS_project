@extends('layouts.dashboard')

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ route('dashboard-index') }}">Dashboard</a>
  </li>
  <!--<li class="breadcrumb-item active">Blank Page</li>-->
</ol>
@endsection

@section('content')
@if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<h1>welcome to Admin</h1>
@endsection
