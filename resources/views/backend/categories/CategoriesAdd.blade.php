@extends('backend.index')
@section('breadcrumb')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ route('backend-index') }}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Add Categories</li>
</ol>
@endsection

@section('content')
@if(Session::has('alert_type'))
<div class="alert alert-{{ Session::get('alert_type') }} alert-dismissible fade show" role="alert">
  {{ Session::get('alert_type') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<h4>Add Categories</h4>
<div class="col-md-6">
  <form action="{{ route('categories.store') }}" method="POST" class="form">
  @method('POST')
  @csrf
      <div class="form-group">
        <label for="categoryname">Category Name</label>
        <input type="text" class="form-control" name="name" value=""></input></td>
        @error('name')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="categoryslug">Category Slug</label>
        <input class="form-control" type="text" name="slug" value=""></input>
        @error('slug')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @enderror
      </div>
      <button class="btn btn-success" type="submit">Add Category</button>

   </form>
</div>
@endsection
