<div class="" id="header">
    <div class="top">
        <div class="container clearfix inside">
            <span id="logo" class="pull-left" title="Du lịch thăng long">
                <a href="{{ route('home') }}"><img src="/assets/img/logo.png" alt="Du lịch thăng long" /></a>
            </span>
            <div class="pull-right">
                <div class="sologan pull-left hidden-xs hidden-sm">
                    <p><strong>Lorem ipsum dolor sit amet</strong></p>
                    <p>Aenean commodo ligula eget dolor.</p>
                </div>
                <div class="pull-right">
                    <div class="hotline">
                        <ul class="list-unstyled list-inline">
                            <li><a href="tel:{{ Config::get('configuration')['hotline'] }}"><i class="fa fa-phone"></i>{{ Config::get('configuration')['hotline'] }}</a></li>
                            <li class="hidden-xs hidden-sm"><a href="tel:{{ Config::get('configuration')['hotline1'] }}"><i class="fa fa-phone"></i>{{ Config::get('configuration')['hotline1'] }}</a></li>
                            <li class="hidden-xs hidden-sm hidden-md"><a href="tel:{{ Config::get('configuration')['hotline2'] }}"><i class="fa fa-phone"></i>{{ Config::get('configuration')['hotline2'] }}</a></li>
                        </ul>
                    </div>
                    <ul class="list-unstyled list-inline list-auth">
                        @if(!$GLB_Login->check())
                            <li><a href="{{ route('auth.login') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('user/register') }}">Đăng ký</a></li>
                        @else
                            <li>
                                <a id="auth-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ $GLB_Login->getUser()->fullname }} <span class="caret"></span> </a>
                                <ul id="auth-menu" class="dropdown-menu" aria-labelledby="auth-dropdown">
                                    <li><a href="{{ route('account.tour.index') }}" title="Danh sách tour">Danh sách tour</a></li>
                                    <li><a href="{{ route('account.tour.edit') }}" title="Đăng tour">Đăng tour</a></li>
                                    <li><a href="{{ route('profile.index') }}" title="Thông tin cá nhân">Thông tin cá nhân</a></li>
                                    <li><a href="{{ route('account.booking.index') }}" title="Bookings của khách">Bookings của khách</a></li>
                                    <li><a href="{{ route('account.booking.me') }}" title="Booking của bạn">Booking của bạn</a></li>
                                    <li><a href="{{ route('logout') }}">Thoát</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="{{ Route::is('home') ? 'active' : ''}}"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        @foreach(\Fsd\Tours\Tour::TYPE as $typeId => $type)
                            <li class="{{ Request::is('*tour/type/' . $typeId . '/*') ? 'active' : ''}}"><a href="{{ route('tour.by.type', [$typeId, $type['slug']]) }}">{{ $type['name'] }}</a></li>
                        @endforeach
                        <li class="{{ Request::is('*post/*') && !Request::is('*post/5/*') ? 'active' : ''}}"><a href="{{ route('post.listAll') }}">Tin tức</a></li>
                        <li class="{{ Request::is('*post/5/*') ? 'active' : ''}}"><a href="{{ route('post.list', [5, 'cam-nang-du-lich']) }}">Cẩm nang du lịch</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>