<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>{{ $setting->getTitle() }}</title>
		<meta name="description" content="{{ $setting->getDescription() }}"/>
		<meta name="author" content="Owner"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="canonical" href="{{ URL::current() }}" />
		<meta itemprop="name" content="Title - owner">
		<meta itemprop="description" content="description">
		<meta property="og:locale" content="vi_VN" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="{{ $setting->getTitle() }}" />
		<meta property="og:description" content="{{ $setting->getDescription() }}" />
		<meta property="og:site_name" content="description" />
		<meta property="og:url" content="{{ URL::current() }}" />
		<meta name="google-site-verification" content="l3ZGqq02KLkUgHxGTESahxpvppqgGdrjgCgShsy4apc" />

      <link rel="icon" href="{{ asset('assets/ico/favicon.ico') }}" type="image/gif" sizes="16x16">
      <link rel="icon" href="{{ asset('assets/ico/favicon.ico') }}" type="image/gif" sizes="32x32">

		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<link href="{{ asset('assets/fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css">
		<!-- Css tour-->
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/tour.css') }}" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">


		<!-- Custom Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
		<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
		@yield('styles')

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body data-spy="scroll" data-target=".scrollspy" data-token="{{ csrf_token() }}">
		<div id="header" style="margin-bottom: 0px;">
			<div class="pro_header_top">
				<div class="fix_980">
					<div class="logo_header">
						<a class="bg_logo" href="/">
							<img src="/assets/img/logo.jpg" alt="dulichthanglong.vn"style="height: 60px;">
						</a>
					</div>
					{{-- <div class="clear"></div> --}}
					<div class="hotline">
					<b>Hotline:</b>
					{{ $setting->getPhone() }}
					</div>
				</div>
			</div>
			<span id="check_scroll_top_header" style="display: block;"></span>
			<div class="pro_header_bottom">
				<div class="fix_980" style="width:980px;">
					<ul class="main_menu">
						<li><a href="/">Trang chủ</a></li>
						<li class="active"><a href="/tim-kiem?q=">Tour</a></li>
						{{-- <li><a href="#" class="deal">Khuyến mãi</a></li>
						<li><a href="#">Cẩm nang du lịch</a></li>
						<li class="other_menu">
							<span class="icon_drop"></span>
							<a class="o_menu" href="/news/">Thông tin</a>
							<div class="show_other_menu">
								<a href="#">Giới thiệu VnGoing</a>
								<a href="#">Tin khuyến mãi</a>
								<a href="#">Chính sách</a>
								<a href="#">Hướng dẫn</a>
								<a href="#">Liên hệ</a>
							</div>
						</li> --}}
					</ul>
					<ul id="not_login" class="nav_other no_login main_menu">
						@if($GLB_Login->check())
							<li class="other_menu">
								<span class="icon_drop"></span>
								<a class="o_menu" style="float: right;">{{ $GLB_Login->getUser()->fullname }}</a>
								<div id="show_other" class="show_other_menu">
									<a href="{{ route('account.tour.index') }}" title="Danh sách tour">Danh sách tour</a>
									<a href="{{ route('account.tour.edit') }}" title="Đăng tour">Đăng tour</a>
									<a href="{{ route('profile.index') }}" title="Thông tin cá nhân">Thông tin cá nhân</a>
									<a href="{{ route('account.booking.index') }}" title="Bookings của khách">Bookings của khách</a>
									<a href="{{ route('account.booking.me') }}" title="Booking của bạn">Booking của bạn</a>
									<a href="{{ route('logout') }}">Thoát</a>
								</div>
							</li>
						@else
							<li><a href="{{ route('auth.login') }}" class="deal">Đăng nhập</a></li>
							<li><a href="{{ route('user/register') }}" class="deal">Đăng ký</a></li>
						@endif
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		</div>