<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>@if(!@empty($meta_title)){{ $meta_title }} @else Relm Report - Dashboard @endif</title>
        @if (!empty($meta_description))
            <meta name="description" content="{{ $meta_description }}">
        @endif
        @if (!empty($meta_keywords))
            <meta name="keyword" content="{{ $meta_keywords }}">
        @endif

        <meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="shortcut icon" href="{{ asset('images/front_images/favicon.png' ) }}">

		<!-- framework - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/bootstrap.min.css') }}">
		<!-- C3 Chart css -->
		<link href="{{ url('libs/c3/c3.min.css') }}" rel="stylesheet" type="text/css">
		<!-- icon - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/app.min.css') }}">

		<!-- animation - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/icons.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/animate.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/style.css') }}">

	</head>


	<body data-sidebar="dark">


		<div id="preloader">
			<div id="status">
				<div class="spinner">
				</div>
			</div>
		</div>

		<!-- preloader - end -->

		<div id="layout-wrapper">

        <!-- header_section - start
         ================================================== -->
        @include('layouts.front_layout.front_header')
        <!-- header_section - end
        ================================================== -->

		<!-- topbar_section - start
		================================================== -->
		@include('layouts.front_layout.front_sidebar')

		<!-- main body - start
		================================================== -->

        @yield('content')

		<!-- main body - end
		================================================== -->

        @include('layouts.front_layout.right_sidebar')
		<!-- footer_section - start
		================================================== -->

		@include('layouts.front_layout.front_footer')

		<!-- footer_section - end
		================================================== -->

		</div>

		<!-- fraimwork - jquery include -->
		<script src="{{ url('libs/jquery/jquery.min.js') }}"></script>
		<script src="{{ url('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ url('libs/metismenu/metisMenu.min.js') }}"></script>

		<!-- animation - jquery include -->
		<script src="{{ url('libs/simplebar/simplebar.min.js') }}"></script>
		<script src="{{ url('libs/node-waves/waves.min.js') }}"></script>

        <!-- Peity chart-->
        <script src="{{ url('libs/peity/jquery.peity.min.js') }}"></script>

        <!--C3 Chart-->
        <script src="{{ url('libs/d3/d3.min.js') }}"></script>
        <script src="{{ url('libs/c3/c3.min.js') }}"></script>

        <script src="{{ url('libs/jquery-knob/jquery.knob.min.js') }}"></script>

        <script src="{{ url('js/front_js/pages/dashboard.init.js') }}"></script>

        <script src="{{ url('js/front_js/app.js') }}"></script>

	</body>
</html>
