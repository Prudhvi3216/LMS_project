@extends('layouts.dashboard')

@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ route('dashboard-index') }}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Categories</li>
</ol>
@endsection

@section('content')
<h4>Categories</h4>

@can('isInstructor')
<category-show :categories="{{ $categories }}"></category-show>
@endcan

@can('isAdmin')
<new-category></new-category>
@foreach($categories as $category)
<category-edit :category="{{ $category }}"></category-edit>
@endforeach
@endcan

@endsection
