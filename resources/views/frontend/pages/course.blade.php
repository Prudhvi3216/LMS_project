@extends('frontend.index')
@section('content')

<!-- heading banner -->
<header class="heading-banner text-white bgCover" style="background-image: url(https://placehold.it/1920x181);">
    <div class="container holder">
        <div class="align">
            <h1>Course Single</h1>
        </div>
    </div>
</header>

<nav class="container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav>

<!-- two columns -->
<div id="two-columns" class="container">
    <curriculum-view :curriculum="{{ json_encode($curriculum) }}" :info="{{ json_encode($info) }}"></curriculum-view>
</div>

@endsection
