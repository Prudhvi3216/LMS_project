<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the HandheldFriendly -->
	<meta name="HandheldFriendly" content="True">
	<!-- set the description -->
	<meta name="description" content="Maxlearnpro">
	<!-- set the Keyword -->
	<meta name="keywords" content="">
	<meta name="Prudhvi Mallavarapu" content="Maxlearnpro">
	<!-- set the page title -->
	<title>Edu Learning Website</title>

	<!-- include google roboto font cdn link -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
	<!-- include the site bootstrap stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/css/colors.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
	<!-- include the site responsive stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

</head>
<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		@include('frontend.partials.header_section')
        <main id="main">
           @yield('content')
        </main>
	</div>
   
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/jquery.js') }} "></script>
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/plugins.js') }}"></script>
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/jquery.main.js') }}"></script>
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/init.js') }}"></script>
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
