<div class="box-wapper row">
    <div class="box col-sm-9" id="box-calendar">
        <div class="header">
            <h3>Lịch khởi hành</h3>
            <div class="clearfix border-header">
                <hr class="hight-line" />
                <hr class="" />
            </div>
        </div>
        <div class="wapper-content clearfix">
            <div class="box-calender col-sm-6">
                <div class="inside">
                    <div class="title">Tour trong nước</div>
                    <div class="content clearfix">
                        <a class="pull-left" href="{{ route('search') }}?departure={{ CITY_HN }}&amp;type={{ Fsd\Tours\Tour::TYPE_INLAND }}">
                            <span class="top">Khởi hành từ</span>
                            <span class="bottom">Hà nội</span>
                        </a>
                        <a class="pull-right" href="{{ route('search') }}?departure={{ CITY_HCM }}&amp;type={{ Fsd\Tours\Tour::TYPE_INLAND }}">
                            <span class="top">Khởi hành từ</span>
                            <span class="bottom">Tp Hồ Chí Minh</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="box-calender col-sm-6">
                <div class="inside">
                    <div class="title">Tour nước ngoài</div>
                    <div class="content clearfix">
                        <a class="pull-left" href="{{ route('search') }}?departure={{ CITY_HN }}&amp;type={{ Fsd\Tours\Tour::TYPE_FOREIGN }}">
                            <span class="top">Khởi hành từ</span>
                            <span class="bottom">Hà nội</span>
                        </a>
                        <a class="pull-right" href="{{ route('search') }}?departure={{ CITY_HCM }}&amp;type={{ Fsd\Tours\Tour::TYPE_FOREIGN }}">
                            <span class="top">Khởi hành từ</span>
                            <span class="bottom">Tp Hồ Chí Minh</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box col-sm-3 support">
        @include('dltl/includes/box-support-only')
    </div>
</div>