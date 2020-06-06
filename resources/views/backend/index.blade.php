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
<h1>welcome to Admin</h1>
@endsection
