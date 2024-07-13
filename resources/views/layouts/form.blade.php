<?php
$url = config('app.url');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>@yield('title', 'Login')</title>
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your,Keywords">
	<meta name="author" content="HimanshuGupta">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Styles -->
	<!-- Bootstrap CSS -->
	<link href="{{ asset('form/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Animate CSS -->
	<link href="{{ asset('form/css/animate.min.css') }}" rel="stylesheet">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="{{ asset('form/css/owl.carousel.css') }}">
	<!-- Font Awesome CSS -->
	<link href="{{ asset('form/css/font-awesome.min.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ asset('form/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('form/style.css') }}" rel="stylesheet">
	<link href="{{ asset('form/css/style-color.css') }}" rel="stylesheet">
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('img/logo/favicon.ico') }}">
</head>

<body>
	<div class="imag" style="background-image: url({{ asset('form/location.jpeg') }}); background-size: cover; width: 100%; height: 100vh;">
		<div class="contain">
			@yield('content')
		</div>
	</div>

	<!-- Javascript files -->
	<!-- jQuery -->
	<script src="{{ asset('form/js/jquery.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('form/js/bootstrap.min.js') }}"></script>
	<!-- WayPoints JS -->
	<script src="{{ asset('form/js/waypoints.min.js') }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('form/js/owl.carousel.min.js') }}"></script>
	<!-- One Page Nav -->
	<script src="{{ asset('form/js/jquery.nav.js') }}"></script>
	<!-- Respond JS for IE8 -->
	<script src="{{ asset('form/js/respond.min.js') }}"></script>
	<!-- HTML5 Support for IE -->
	<script src="{{ asset('form/js/html5shiv.js') }}"></script>
	<!-- Custom JS -->
	<script src="{{ asset('form/js/custom.js') }}"></script>
</body>

</html>