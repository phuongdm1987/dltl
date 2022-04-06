<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Trang chủ :: Rv_Tour</title>
		<meta name="google-site-verification" content="T5QmFLMRpWm-OTKvHchxN-KDNZAvycihstvSB2rvS-M" />
      <meta name="keywords" content="Developer, tutorial, programer"/>
      <meta name="description" content="Trang thông tin tour Viêt Nam và nước ngoài"/>
      <meta name="author" content="FSD.14"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="canonical" href="http://fsd14.dev" />
      <meta itemprop="name" content="Trang chủ :: FSD.14">
      <meta itemprop="description" content="Trang thông tin tour Viêt Nam và nước ngoài">
      <meta property="og:locale" content="vi_VN" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="Trang chủ :: FSD.14" />
      <meta property="og:description" content="Trang thông tin tour Viêt Nam và nước ngoài" />
      <meta property="og:site_name" content="FSD.14" />
      <meta property="og:url" content="http://fsd14.dev" />
      <meta name="twitter:card" content="summary">
      <meta name="twitter:site" content="@VNFSD  ">
      <meta name="twitter:title" content="Trang chủ :: FSD.14">
      <meta name="twitter:description" content="Trang thông tin tour Viêt Nam và nước ngoài">
      <meta name="twitter:creator" content="@fsd14">

		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>
		<!-- Bootstrap and Font Awesome css -->
		<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>

		<!-- Css animations  -->
		<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/owl.theme.css') }}" rel="stylesheet">

		<!-- Css tour-->
		<link href="{{ asset('assets/css/tour.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css">

		<!--Include file css customer-->
		@yield('styles')

		<!-- Responsivity for older IE -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Favicon and apple touch icons-->
		<link rel="shortcut icon" href="{{ asset('assets/img/favicon16.jpg') }}" type="image/gif" sizes="16x16" />
		<link rel="shortcut icon" href="{{ asset('assets/img/favicon32.jpg') }}" type="image/gif" sizes="32x32" />
	</head>
	<body data-spy="scroll" data-target=".scrollspy">
      <div id="header" style="margin-bottom: 0px;">
         <div class="pro_header_top">
            <div class="fix_980">
               <div class="logo_mytour">
                  <a class="bg_logo" href="/">
                     <img src="http://static.mytour.vn:8080/themes/images/logo_new.png" alt="Mytour.vn">
                  </a>
               </div>
               <div class="support_mytour">
                  <table cellpadding="0" cellspacing="0">
                     <tbody><tr>
                        <td rowspan="3"><span class="icon_phone"></span></td>
                        <td colspan="2"><p style="white-space: nowrap;">Đặt phòng trực tuyến, hoặc gọi</p></td>
                     </tr>
                     <tr>
                        <td><b>Hà Nội: </b></td><td><span class="more_info_show">(04) 7109 9999</span></td>          </tr>
                     <tr>
                        <td><b>Hồ Chí Minh: </b></td><td><span class="more_info_show">(08) 7309 9899</span></td>           </tr>
                  </tbody></table>
               </div>
               <div class="time_support" style="height: 48px !important;padding-top: 10px !important;">
                  <table cellpadding="0" cellspacing="0">

                     <tbody><tr>
                        <td valign="bottom" rowspan="2">
                           <span class="icon_time"></span>
                        </td>

                        <td>T2 - CN:</td>
                        <td><b>08:00 - 23:00 (HN)</b></td>
                     </tr>

                     <tr>
                        <td>T2 - CN:</td>
                        <td><b>08:00 - 17:30 (HCM)</b></td>
                     </tr>

                  </tbody></table>
                  <span class="separate"></span>
               </div>
               <div class="clear"></div>
            </div>
         </div>
         <span id="check_scroll_top_header" style="display: block;"></span>
         <div class="pro_header_bottom">
            <div class="fix_980">
                     <ul class="main_menu">
                        <li><a href="/">Khách sạn</a></li><li class="active"><a href="/tour/">Tour</a></li><li><a href="/deal/hotel/" class="deal">Khuyến mãi</a></li><li><a href="/location/n1/du-lich-viet-nam.html">Cẩm nang du lịch</a></li>            <li class="other_menu">
                           <span class="icon_drop"></span>
                           <a class="o_menu" href="/news/">Thông tin</a>

                           <div class="show_other_menu">
                              <a href="/news/ca295/gioi-thieu-mytour-vn.html">Giới thiệu Mytour</a><a href="/news/ca300/chuong-trinh-khuyen-mai.html">Tin khuyến mãi</a><a href="/news/ca296/chinh-sach.html">Chính sách</a><a href="/news/ca297/huong-dan.html">Hướng dẫn</a><a href="/help/30-lien-he.html">Liên hệ</a>              </div>
                        </li>
                     </ul>
                     <div id="not_login" class="nav_other no_login">
                        <a rel="nofollow" onclick="windowPrompt({href: 'https://id.vatgia.com/dang-nhap?_cont=http://mytour.vn/home/sso.php?url=aHR0cDovL215dG91ci52bi90b3VyLw==&amp;ui.mode=popup&amp;service=mytour', iframe: true, width: '660px', height: '401px'});">Đăng nhập</a>
                        <a rel="nofollow" href="https://id.vatgia.com/dang-ky/?_cont=http://mytour.vn/tour/&amp;service=mytour" target="_blank" title="Đăng ký thành viên">Đăng ký</a>
                     </div>
                     <div class="clear"></div>
            </div>
         </div>
      </div>

