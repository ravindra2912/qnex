<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@php
	$customeseo = getSeo(url()->current());
	if ($customeseo['seo']) {
	$seo['title'] = $customeseo['seo']['meta_title'];
	$seo['description'] = $customeseo['seo']['meta_description'];
	$seo['keywords'] = $customeseo['seo']['meta_keywords'];
	}
	@endphp

	@if (isset($seo) && !empty($seo))
	<title>{{ $seo['title'] }}</title>

	<meta name="description" content="{{ $seo['description'] }}" />
	<meta name="keywords" content="{{ $seo['keywords'] }}" />

	<meta name="distribution" content="global">
	<meta http-equiv="content-language" content="en-gb">
	<meta name="city" content="{{ $seo['city'] }}">
	<meta name="state" content="{{ $seo['state'] }}">
	<meta name="geo.region" content="IN-GJ">
	<meta name="DC.title" content="{{ $seo['title'] }}">
	<meta name="geo.position" content="{{ $seo['position'] }}">
	<meta name="ICBM" content="{{ $seo['position'] }}">
	<meta name="geo.region" content="IN-{{ strtoupper(substr($seo['state'], 0, 2)) }}">
	<meta name="geo.placename" content="{{ $seo['city'] }}">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="al:web:url" content="{{ url()->current() }}">

	<meta name="copyright" content="{{$customeseo['domain']}}">

	<meta property="og:title" content="{{ $seo['title'] }}" />
	<meta property="og:description" content="{{ $seo['description'] }}" />
	<meta property="og:keywords" content="{{ $seo['keywords'] }}" />
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:type" content="Car and Taxi Booking Website" />
	<meta property="og:site_name" content="{{$customeseo['domain']}} - Car and Taxi Booking Website">
	<meta property="og:locale" content="en_GB">
	<meta property="og:image" content="{{ config('const.site_setting.fevicon') }}">
	<!-- <meta property="og:image:width" content="550" />
		<meta property="og:image:height" content="413" /> -->

	<meta name="author" content="{{$customeseo['domain']}} Car and Taxi Booking " />

	<meta property="twitter:card" content="summary">
	<meta property="twitter:site" content="{{$customeseo['domainwithdot']}}">
	<meta property="twitter:title" content="{{ $seo['title'] }}">
	<meta property="twitter:description" content="{{ $seo['description'] }}">
	<meta property="twitter:image" content="{{ config('const.site_setting.fevicon') }}">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta name="twitter:domain" content="{{$customeseo['domain']}}">

	<meta name="robots" content="index,follow" />
	@else
	<title>{{ config('const.site_setting.name') }}</title>
	@endif

	<link rel="apple-touch-icon" sizes="180x180" href="{{ config('const.site_setting.fevicon') }}">
	<link rel="canonical" href="{{ url()->current() }}" />
	<link rel="icon" type="image/webp" href="{{ config('const.site_setting.fevicon') }}">

	<link href="{{ asset('assets/front/img/favicon.ico') }}" rel="icon">
	<!-- Bundle -->
	<link href="{{ asset('assets/front/vendor/css/bundle.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/front/vendor/css/revolution-settings.min.css') }}" rel="stylesheet">
	<!-- Plugin Css -->
	<link href="{{ asset('assets/front/vendor/css/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/front/vendor/css/cubeportfolio.min.css') }}" rel="stylesheet">
	<!--Toastr -->

	<!-- Style Sheet -->
	<link href="{{ asset('assets/front/agency/css/style.css') }}" rel="stylesheet">





	<style>
		/* Hide fullnav-toggler on desktop */
		@media screen and (min-width: 992px) {
			.fullnav-toggler {
				display: none !important;
			}
		}
	</style>

	@stack('style')
</head>

<body data-offset="90" data-spy="scroll" data-target=".navbar">

	<!-- Preloader -->
	<!-- <div class="preloader">
		<div class="box"></div>
	</div> -->

	<!-- Ink Transition -->
	<!-- <div class="cd-transition-layer visible opening">
		<div class="bg-layer"></div>
	</div> -->
	<!--/Preloader -->

	<!--Header Start-->
	<header class="cursor-light">

		<!--Navigation-->
		<nav class="navbar navbar-top-default navbar-expand-lg navbar-gradient nav-icon alt-font">
			<div class="container">
				<a class="logo link" href="{{ route('home') }}" title="Logo">
					<!--Logo Default-->
					<img alt="logo" class="logo-dark default" src="{{ config('const.site_setting.logo') }}">
				</a>


				<!--Nav Links-->
				<div class="collapse navbar-collapse" id="agency">
					<div class="navbar-nav ml-auto">
						<a class="nav-link link {{ request()->routeIs('home') ? 'scroll active' : '' }}" href="{{ route('home') }}#home">Home</a>
						<a class="nav-link link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#about-us">About Us</a>
						<a class="nav-link link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#portfolio">Our Work</a>
						<a class="nav-link link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#clients">Clients</a>
						<a class="nav-link link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">Our Blog</a>
						<a class="nav-link link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#contact">Contact Us</a>
						<span class="menu-line"><i aria-hidden="true" class="fa fa-angle-down"></i></span>
					</div>

				</div>

				<!--Menu Button-->
				<button class="fullnav-toggler link" id="full-menu-1" type="button">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</button>

				<!--Slider Social-->
				<div class="slider-social">
					<ul class="list-unstyled">
						@if(config('const.socialMedia.facebook'))
						<li class="animated-wrap"><a class="animated-element" href="{{config('const.socialMedia.facebook')}}"><i
									aria-hidden="true" class="fab fa-facebook-f"></i></a></li>
						@endif
						@if(config('const.socialMedia.instagram'))
						<li class="animated-wrap"><a class="animated-element" href="{{config('const.socialMedia.instagram')}}"><i
									aria-hidden="true" class="fab fa-instagram"></i></a></li>
						@endif
						@if(config('const.socialMedia.linkedin'))
						<li class="animated-wrap"><a class="animated-element" href="{{config('const.socialMedia.linkedin')}}"><i
									aria-hidden="true" class="fab fa-linkedin-in"></i></a></li>
						@endif
					</ul>
				</div>

			</div>
		</nav>

		<!--Full menu-->
		<div class="nav-holder main style-2 alt-font">
			<button class="fullnav-close link" type="button">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</button>
			<div class="container">
				<div class="shape-left">
					<nav class="navbar full-menu-navigation left">
						<ul class="list-unstyled">
							<li><a class="link {{ request()->routeIs('home') ? 'scroll active' : '' }}" href="{{ route('home') }}#home">
									<span class="anchor-circle"></span>
									<span class="anchor-text">Home</span>
								</a></li>
							<li><a class="link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#about-us">
									<span class="anchor-circle"></span>
									<span class="anchor-text">About</span>
								</a></li>
							<li><a class="link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#portfolio">
									<span class="anchor-circle"></span>
									<span class="anchor-text">Work</span>
								</a></li>
							<li><a class="link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#clients">
									<span class="anchor-circle"></span>
									<span class="anchor-text">Clients</span>
								</a></li>
							<li><a class="link " href="{{ route('blog.index') }}">
									<span class="anchor-circle"></span>
									<span class="anchor-text">Blog</span>
								</a></li>
							<li><a class="link {{ request()->routeIs('home') ? 'scroll' : '' }}" href="{{ route('home') }}#contact">
									<span class="anchor-circle"></span>
									<span class="anchor-text">Contact</span>
								</a></li>
						</ul>
						<span class="full-menu-dot" style="transform: scale(0);"></span>
					</nav>
					<img alt="shape" src="{{ asset('assets/front/agency/img/shape-8.png') }}">
				</div>
				<div class="shape-right">
					<img alt="shape" src="{{ asset('assets/front/agency/img/shape-7.png') }}">
				</div>
			</div>
		</div>



	</header>
	<!--Header End-->
	@yield('content')
	<!--Footer Start-->
	<footer class="footer-style-1 bg-light">
		<div class="container">
			<div class="row align-items-center">
				<!--Social-->
				<div class="col-md-6">
					<div class="footer-social">
						<ul class="list-unstyled">
							@if(config('const.socialMedia.facebook'))
							<li><a class="wow fadeInUp" href="{{config('const.socialMedia.facebook')}}"><i aria-hidden="true" class="fab fa-facebook-f"></i></a></li>
							@endif
							@if(config('const.socialMedia.instagram'))
							<li><a class="wow fadeInUp" href="{{config('const.socialMedia.instagram')}}"><i aria-hidden="true" class="fab fa-instagram"></i></a></li>
							@endif
							@if(config('const.socialMedia.linkedin'))
							<li><a class="wow fadeInDown" href="{{config('const.socialMedia.linkedin')}}"><i aria-hidden="true" class="fab fa-linkedin-in"></i></a></li>
							@endif
							@if(config('const.socialMedia.threads'))
							<li><a class="wow fadeInDown" href="{{config('const.socialMedia.threads')}}"><i aria-hidden="true" class="fab fa-threads"></i></a></li>
							@endif
							@if(config('const.socialMedia.google_business'))
							<li><a class="wow fadeInUp" href="{{config('const.socialMedia.google_business')}}"><i aria-hidden="true" class="fab fa-google"></i></a></li>
							@endif
							@if(config('const.socialMedia.youtube'))
							<li><a class="wow fadeInDown" href="{{config('const.socialMedia.youtube')}}"><i aria-hidden="true" class="fab fa-youtube"></i></a></li>
							@endif
						</ul>
					</div>
				</div>
				<!--Text-->
				<div class="col-md-6 text-md-right">
					<p class="company-about fadeIn">&copy; {{ date('Y') }} {{ config('const.site_setting.name') }}. All Rights Reserved.
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!--Footer End-->

	<!--Animated Cursor-->
	<div id="aimated-cursor">
		<div id="cursor">
			<div id="cursor-loader"></div>
		</div>
	</div>
	<!--Animated Cursor End-->

	<!--Scroll Top Start-->
	<span class="scroll-top-arrow"><i class="fas fa-angle-up"></i></span>
	<!--Scroll Top End-->

	<!-- JavaScript -->
	<script src="{{ asset('assets/front/vendor/js/bundle.min.js') }}"></script>
	<!-- Plugin Js -->
	<script src="{{ asset('assets/front/vendor/js/jquery.appear.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/morphext.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/TweenMax.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/jquery.cubeportfolio.min.js') }}"></script>
	<!-- REVOLUTION JS FILES -->
	<script src="{{ asset('assets/front/vendor/js/jquery.themepunch.tools.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/jquery.themepunch.revolution.min.js') }}"></script>
	<!-- SLIDER REVOLUTION EXTENSIONS -->
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.actions.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.migration.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.navigation.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.parallax.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/js/extensions/revolution.extension.video.min.js') }}"></script>
	<!-- custom script -->
	<script src="{{ asset('assets/front/agency/js/script.js') }}"></script>

	@stack('js')

</body>

</html>