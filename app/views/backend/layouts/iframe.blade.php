<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>
         @section('title')
         Administration
         @show
      </title>
      <meta name="keywords" content="Administrator page" />
      <meta name="author" content="Flypaper" />
      <meta name="description" content="Administrator page" />

      <!-- CSS
      ================================================== -->
      <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/iframe-content.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('assets/js/fancybox/source/jquery.fancybox.css') }} " />
      <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
      @yield('styles')

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
      <!-- Notifications -->
      <section id="notification">
         @include('frontend/notifications')
      </section>

      <!-- Content -->
      @yield('content')

      <!-- Javascripts
      ================================================== -->
      <script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/js/main.js') }}"></script>
      <script src="{{ asset('assets/js/functions.js') }}"></script>
      <script src="{{ asset('assets/js/iframe-content.js') }}"></script>
      <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('assets/js/tinymce4x/tinymce.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/fancybox/source/jquery.fancybox.pack.js') }}"></script>
      <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
      @yield('scripts')
   </body>
</html>
