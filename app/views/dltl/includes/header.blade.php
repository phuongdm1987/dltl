<div class="" id="header">
    <div class="top">
        <div class="container clearfix inside">
            <h1 id="logo" class="pull-left" title="Du lịch thăng long">
                <img src="/assets/img/logo.png" alt="Du lịch thăng long" />
            </h1>
            <div class="pull-right">
                <div class="sologan pull-left hidden-xs hidden-sm">
                    <p><strong>Lorem ipsum dolor sit amet</strong></p>
                    <p>Aenean commodo ligula eget dolor.</p>
                </div>
                <div class="pull-right">
                    <div class="hotline">
                        <i class="fa fa-phone"></i> Hotline: 0927.253.666
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
                        <li><a href="#">Khuyến mại</a></li>
                        <li class="{{ Request::is('*/tour-du-lich-trong-nuoc') ? 'active' : ''}}"><a href="{{ route('tour.by.type', [Fsd\Tours\Tour::TYPE_INLAND, 'trong-nuoc']) }}">Tour trong nước</a></li>
                        <li class="{{ Request::is('*/tour-du-lich-nuoc-ngoai') ? 'active' : ''}}"><a href="{{ route('tour.by.type', [Fsd\Tours\Tour::TYPE_FOREIGN, 'nuoc-ngoai']) }}">Tour nước ngoài</a></li>
                        @foreach($GLB_Categories as $category)
                            <li class="{{ Request::is('*post/list/' . $category->id . '-*') ? 'active' : ''}}"><a href="{{ $category->getUrlBlog() }}">{{ $category->name }}</a></li>
                        @endforeach
                        <!-- <li><a href="#">Khách hàng</a></li>
                        <li><a href="#">Dịch vụ visa</a></li>
                        <li><a href="#">Thuê xe</a></li>
                        <li><a href="#">Tin du lịch</a></li> -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>