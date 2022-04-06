<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Basic Page Needs
      ================================================== -->
      <meta charset="utf-8" />
      <title>{{ $setting->getTitle() . ' :: ' . $setting->getOwner() }}</title>
      <meta name="keywords" content="{{ $setting->getKeywords() }}"/>
      <meta name="description" content="{{ $setting->getDescription() }}"/>
      <meta name="author" content="{{ $setting->getOwner() }}"/>
      <meta property="og:title" content="{{ $setting->getTitle() . ' :: ' . $setting->getOwner() }}">
      <meta property="og:keywords" content="{{ $setting->getKeywords() }}">
      <meta property="og:description" content="{{ $setting->getDescription() }}">
      <meta content="noodp,index,follow" name="robots">
      <meta content="{{ url() }}" property="og:url">
      <meta content="{{ url() }}" property="og:site_name">
      <meta content="product" property="og:type">

      <!-- Mobile Specific Metas
      ================================================== -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- CSS
      ================================================== -->
      <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
      <link href="{{ asset('assets/css/admin-auth.css') }}" rel="stylesheet">

      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="{{ asset('assets/js/html5.js') }}"></script>
      <![endif]-->

      <!-- Favicons
      ================================================== -->
      <link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
      <style type="text/css">
         @yield('styles')
      </style>
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
      {{ $setting->getGACode() }}
   </body>
</html>