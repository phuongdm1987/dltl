<!DOCTYPE html>
<html lang="en">
   <head>
      <title>{{ $setting->getTitle() . ' :: ' . $setting->getOwner() }} </title>
      <meta name="keywords" content="{{ $setting->getKeywords() }}"/>
      <meta name="description" content="{{ $setting->getDescription() }}"/>
      <meta name="author" content="{{ $setting->getOwner() }}"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/bootstrap-social.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
      <link href="{{ asset('assets/css/common.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
      @yield('styles')

      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

      <link rel="icon" href="{{ asset('assets/ico/favicon16.gif') }}" type="image/gif" sizes="16x16">
      <link rel="icon" href="{{ asset('assets/ico/favicon32.gif') }}" type="image/gif" sizes="32x32">
   </head>

   <body>
      <!-- Container -->
      <section class="container" id="auth-wrapper">
         <!-- Content -->
         @yield('content')
      </section>

      <!-- Javascripts
      ================================================== -->
   </section>
      <script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
      @yield('scripts')
   </body>
</html>