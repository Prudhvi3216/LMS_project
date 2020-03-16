@extends('layouts.dashboard')

@section('content')
<instructor-courses :courses="{{ json_encode($courses) }}" class="mt-4"></instructor-courses>
@endsection