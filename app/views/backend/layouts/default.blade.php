<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Administration
			@show
		</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="keywords" content="Administrator page" />
		<meta name="author" content="Flypaper" />
		<meta name="description" content="Administrator page" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

		<style>
			@yield('styles')
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
		<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
	</head>

	<body>
		<!-- Navbar -->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav pull-right">
							<li><a href="{{ URL::to('/') }}" target="_blank">Trang chủ</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown">
									{{ Auth::getUser()->fullName() }}
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{ route('logout') }}">Thoát</a></li>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div id="wrapper">
			<div id="side-bar">
				@include('backend/sidebar')
			</div>
			<div id="tab-container">
				<a href="#" class="btn btn-link tab-control" id="tab-control-left"><i class="fa fa-angle-left"></i></a>
				<ul class="list-unstyled" id="tab-list">
					<li class="active" id="tab-1"><a href="#iframe-tab-1">Dashboard</a></li>
				</ul>
				<a href="#" class="btn btn-link tab-control" id="tab-control-right"><i class="fa fa-angle-right"></i></a>
			</div>
			<div id="main-page">
				<div id="frame-container">
					<div id="iframe-tab-1" class="tab-frame">
						<iframe src="/admin/dashboard" frameborder="0" width="100%" height="100%"></iframe>
					</div>
				</div>
			</div>
		</div>

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/main.js') }}"></script>
		<script>
			@yield('scripts')
		</script>
	</body>
</html>
