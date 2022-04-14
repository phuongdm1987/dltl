<title>{{ $setting->getTitle() }}</title>
<meta charset="UTF-8">
{{-- <meta name="google-site-verification" content="T5QmFLMRpWm-OTKvHchxN-KDNZAvycihstvSB2rvS-M" /> --}}
<meta name="keywords" content="{{ $setting->getKeywords() }}"/>
<meta name="description" content="{{{ $setting->getDescription() }}}"/>
<meta name="author" content="{{ $setting->getOwner() }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="canonical" href="{{ URL::current() }}" />
<meta itemprop="name" content="{{ $setting->getOwner() }}">
<meta itemprop="description" content="{{{ $setting->getDescription() }}}">
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $setting->getTitle() }}" />
<meta property="og:image" content="{{ $setting->getOgImage() }}" />
<meta property="og:description" content="{{{ $setting->getDescription() }}}" />
<meta property="og:site_name" content="{{ $_SERVER['REQUEST_URI'] }}" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta name="twitter:card" content="{{ $setting->getOwner() }}">
<meta name="twitter:site" content="{{ $setting->getTwitter() }} ">
<meta name="twitter:title" content="{{ $setting->getTitle() }}">
<meta name="twitter:description" content="{{{ $setting->getDescription() }}}">
<meta name="twitter:creator" content="{{ $setting->getTwitter()}} ">
{{--<meta name="google-site-verification" content="l3ZGqq02KLkUgHxGTESahxpvppqgGdrjgCgShsy4apc" />--}}
<meta name="google-site-verification" content="LtYzs6cnsJIdnttMFNUU68PajqMQdqhr8DgwFII9uIs" />
