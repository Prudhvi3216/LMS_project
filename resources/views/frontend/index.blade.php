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
	<meta name="description" content="STUDYLMS HTML Template">
	<!-- set the Keyword -->
	<meta name="keywords" content="">
	<meta name="author" content="STUDYLMS HTML Template">
	<!-- set the page title -->
	<title>STUDYLMS HTML Template</title>
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
	<div id="app">
		<div id="wrapper">
		@include('frontend.partials.header_section')
			<!--
			<header id="page-header" class="page-header-stick">
				<header-topbar></header-topbar>
				<header-holder></header-holder>
			</header>
			-->
			
			<main id="main">
				@yield('content')
			</main>
		</div>
	</div>
	
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/plugins.js') }}"></script>
	<!-- include jQuery -->
	<script src="{{ asset('frontend/js/jquery.main.js') }}"></script>
	<!-- include jQuery -->
	<script type="text/javascript" src="{{ asset('frontend/js/init.js') }}"></script>

	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
