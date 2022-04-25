<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="/assets/img/favicon_32.jpg">
    @include('dltl/includes/metadata')
    <!-- core css -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/assets/css-min/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
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
    @yield('content')
    {{-- footer --}}
    @include('dltl/includes/footer')

<!-- javascript -->
{{-- <script src="/assets/js/jquery.js"></script> --}}
<script src="/assets/js/jquery-2.2.4.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-datepicker/locales/bootstrap-datepicker.vi.min.js"></script>
<script src="/assets/frontend/js/frontend.js"></script>
@yield('script')
<script type="text/javascript" src="/assets/js/skype-uri.js"></script>
<script type="text/javascript">
    Skype.ui({
        "name": "chat",
        "element": "SkypeButton_Call_caothanhdoan_1",
        "participants": ["caothanhdoan"],
        "imageSize": 24
    });

    Skype.ui({
        "name": "chat",
        "element": "SkypeButton_Call_dulichthanglong1_1",
        "participants": ["dulichthanglong1"],
        "imageSize": 24
    });
</script>

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "1534388980222673");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v13.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

{{-- Ga code --}}
{{ $setting->getGACode() }}
</body>
</html>