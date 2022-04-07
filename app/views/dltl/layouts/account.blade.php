<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="/assets/img/favicon_32.png">
    @include('dltl/includes/metadata')
    <!-- core css -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/assets/css-min/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
    <!-- custom style -->
    <link rel="stylesheet" href="/assets/frontend/css-min/frontend.css">

    @yield('style')
</head>

<body data-token="{{ csrf_token() }}">
    {{-- navbar --}}
    @include('dltl/includes/header')
    {{-- help start --}}
    <div class="notifications">
        @include('dltl/includes/notification')
    </div>

    <div class="container">
        <div id="wrapper_content">
            <div class="box-wapper row">
                <div class="col-sm-3" id="aside">
                    @include('dltl/includes/account/nav')
                </div>
                <div class="col-sm-9" id="main-content">
                    @yield('content')
                </div>
            </div>
        </div>
   </div>
   <div id="loading"></div>

    {{-- footer --}}
    @include('dltl/includes/footer')

<!-- javascript -->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-datepicker/locales/bootstrap-datepicker.vi.min.js"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/spin.min.js') }}"></script>
<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="/assets/frontend/js/frontend.js"></script>
<script src="{{ asset('assets/js/functions.js') }}"></script>
@yield('script')
</body>
</html>