<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- set the HandheldFriendly -->
	<meta name="HandheldFriendly" content="True">
	<!-- set the description -->
	<meta name="description" content="">
	<!-- set the Keyword -->
	<meta name="keywords" content="Learning">
	<meta name="author" content="Prudhvi Raju">
	<!-- set the page title -->
	<title>Maxxlearn Pro - Online Education for Professionals</title>
	<!-- include google roboto font cdn link -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
	
	<!-- Bootstrap 4.1 -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
	 
	<!-- include the site responsive stylesheet -->
	<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

</head>
<body>
	<div id="app">
		<nav-menu></nav-menu>	
		<router-view></router-view>
		<footer-component></footer-component>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
