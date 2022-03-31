<div class="container-fuild" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 social">
                <div class="content">
                    <p>{{ $setting->getOwner() }}</p>
                    <p>Địa chỉ: {{ $setting->getAddress() }}</p>
                    <p>Mã Số Thuế : 0107031441</p>
                </div>
                <div class="icon">
                    <a href="{{ $setting->getFacebook() }}"><i class="fa fa-facebook"></i></a>
                    <a href="{{ $setting->getTwitter() }}"><i class="fa fa-twitter"></i></a>
                    <a href="{{ $setting->getGplus() }}"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-sm-3 register-news">
                <form method="post">
                    <p class="title">Đăng ký nhận bản tin qua email</p>
                    <input type="text" class="form-control" name="email" placeholder="Nhập địa chỉ email của bạn" />
                    <p class="note">* Chúng tôi không spam bạn, bạn có thể hủy bất cứ lúc nào</p>
                    <inputt type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button type="submit" class="btn btn-dltl">Đăng ký</button>
                </form>
            </div>
            <ul class="col-sm-3 about list-unstyled">
                <li><a href="#">Về chúng tôi</a></li>
                <li><a href="#">Hướng dẫn sử dụng</a></li>
                <li><a href="#">Chính sách đảm bảo phòng</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Việc làm</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Quy định sử dụng</a></li>
                <li><a href="#">Phản hồi</a></li>
            </ul>
            <div class="col-sm-3 contact">
                <p class="title">Mọi thắc mắc vui lòng liên hệ</p>
                <div class="phone">
                    <p><span>Phòng kinh doanh</span><span class="pull-right">{{ Config::get('configuration')['hotline1'] }}</span></p>
                    <p><span>phòng điều hành</span><span class="pull-right">{{ Config::get('configuration')['hotline2'] }}</span></p>
                </div>
                <p class="note">(!!) Giải quyết mọi thắc mắc của bạn 24/7</p>
            </div>
        </div>
    </div>
</div>

<div class="bar-fixed-bottom device-pc-show">
    <div class="tag-red hidden-xs">
        <span>Hotline</span>
        <span class="tag-arrow-right"></span>
    </div>
    <div class="hotline-content">
        <ul class="clearfix">
            <li>
                <span class="red-dark">Office:</span>
                <span class="text-df">{{ Config::get('configuration')['hotline1'] }}</span>
            </li>
            <li>
                <span class="red-dark">Mobile:</span>
                <span class="text-df">{{ Config::get('configuration')['hotline2'] }}</span>
            </li>
            <li class="hidden-xs" id="SkypeButton_Call_dulichthanglong1_1" data-toggle="tooltip" title="Du Lịch Thăng Long"></li>
            <li class="hidden-xs" id="SkypeButton_Call_caothanhdoan_1" data-toggle="tooltip" title="Cao Thanh Đoàn"></li>
            <li><a href="{{ $setting->getFacebook() }}" data-toggle="tooltip" title="Du lịch thăng long" class="btn btn-xs"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a></li>
        </ul>
    </div>

    <!--Translate-->
    <div id="google_translate_element"></div>
    <div class="clear"></div>
</div>
