<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>@if(!@empty($meta_title)){{ $meta_title }} @else Mfuko - Send and receive your packag @endif</title>
        @if (!empty($meta_description))
            <meta name="description" content="{{ $meta_description }}">
        @endif
        @if (!empty($meta_keywords))
            <meta name="keyword" content="{{ $meta_keywords }}">
        @endif

        <meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="shortcut icon" href="{{ asset('images/front_images/logo/favourite_icon.png' ) }}">

		<!-- framework - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/bootstrap.min.css') }}">

		<!-- icon - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/fontawesome.css') }}">

		<!-- animation - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/aos.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/animate.css') }}">

		<!-- carousel - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/slick.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/slick-theme.css') }}">

		<!-- popup - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/magnific-popup.css') }}">

		<!-- select options - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/nice-select.css') }}">

		<!-- pricing range - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/jquery-ui.css') }}">

		<!-- custom - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/style.css') }}">

	</head>


	<body>


		<!-- backtotop - start -->
		<div id="thetop"></div>
		<div class="backtotop">
			<a href="#" class="scroll">
				<i class="far fa-arrow-up"></i>
			</a>
		</div>
		<!-- backtotop - end -->

		<!-- preloader - start -->
		<div class="preloader">
			<div class="animation_preloader">
				<div class="spinner"></div>
				<p class="text-center">Loading</p>
			</div>
			<div class="loader">
				<div class="row vh-100">
					<div class="col-3 loader_section section-left">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-left">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-right">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-right">
						<div class="bg"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- preloader - end -->


		<!-- header_section - start
		================================================== -->
		@include('layouts.front_layout.front_header')
		<!-- header_section - end
		================================================== -->


		<!-- main body - start
		================================================== -->

        @yield('content')

		<!-- main body - end
		================================================== -->


		<!-- footer_section - start
		================================================== -->

		@include('layouts.front_layout.front_footer')

		<!-- footer_section - end
		================================================== -->


		<!-- fraimwork - jquery include -->
		<script src="{{ url('js/front_js/jquery-3.5.1.min.js') }}"></script>
		<script src="{{ url('js/front_js/popper.min.js') }}"></script>
		<script src="{{ url('js/front_js/bootstrap.min.js') }}"></script>

		<!-- animation - jquery include -->
		<script src="{{ url('js/front_js/aos.js') }}"></script>
		<script src="{{ url('js/front_js/parallaxie.js') }}"></script>

		<!-- carousel - jquery include -->
		<script src="{{ url('js/front_js/slick.min.js') }}"></script>

		<!-- popup - jquery include -->
		<script src="{{ url('js/front_js/magnific-popup.min.js') }}"></script>

		<!-- select ontions - jquery include -->
		<script src="{{ url('js/front_js/nice-select.min.js') }}"></script>

		<!-- isotope - jquery include -->
        <script src="{{ url('js/front_js/isotope.pkgd.js') }}"></script>
        <script src="{{ url('js/front_js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ url('js/front_js/masonry.pkgd.min.js') }}"></script>

		<!-- google map - jquery include -->
		<script src="https:/maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
        <script src="{{ url('js/front_js/gmaps.min.js') }}"></script>

		<!-- pricing range - jquery include -->
		<script src="{{ url('js/front_js/jquery-ui.js') }}"></script>

		<!-- counter - jquery include -->
		<script src="{{ url('js/front_js/waypoint.js') }}"></script>
		<script src="{{ url('js/front_js/counterup.min.js') }}"></script>

		<!-- contact form - jquery include -->
        <script src="{{ url('js/front_js/validate.js') }}"></script>

		<!-- mobile menu - jquery include -->
        <script src="{{ url('js/front_js/mCustomScrollbar.js') }}"></script>

		<!-- custom - jquery include -->
		<script src="{{ url('js/front_js/custom.js') }}"></script>
		<script src="{{ url('js/front_js/front_script.js') }}"></script>


	</body>
</html>
