@extends('layouts.dashboard')

@section('content')
<instructor-profile :info="{{ json_encode($inst_info) }}"  class="mt-2 col-md-8"></instructor-profile>
@endsection