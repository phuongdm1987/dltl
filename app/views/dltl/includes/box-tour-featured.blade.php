<div class="box-wapper row">
    <div class="header col-sm-12">
        <h3>Tour du lịch nổi bật</h3>
        <div class="clearfix border-header">
            <hr class="hight-line" />
            <hr class="" />
        </div>
    </div>
    <div class="box tour-featured col-sm-6" id="tour-domestic">
        <div class="inside row">
            <div class="show-content col-sm-6">
                <h2 class="title">Tour trong nước</h2>
                <div class="wapper-content">
                    @foreach($tourInlandHot as $key => $tour)
                        @if($key == 0)
                            <div class="img">
                                <a href="{{ $tour->getUrl() }}"><img src="{{ $tour->getImage('md_') }}" alt="" /></a>
                            </div>
                            <div class="tour-content">
                                <h3 class="tour-name"><a href="{{ $tour->getUrl() }}">{{ $tour->tou_name }}</a></h3>
                                <p>Thời gian: {{ $tour->getDayNight() }}</p>
                                <p class="price">Gía từ: {{ $tour->getPricePub() }}d</p>
                                <p class="discount">Gía KM: {{ $tour->getPrice() }}d</p>
                                <p>Lịch khởi hành: {{ $tour->getTourStartType() }}</p>
                                <p>Lịch trình: {{ $tour->getPlace() }}</p>
                            </div>
                            <div class="tour-detail clearfix">
                                <a href="{{ $tour->getUrl() }}" class="btn btn-default pull-left">Xem chi tiết</a>
                                <a href="{{ $tour->getUrl() }}" class="btn btn-dltl pull-right">Đặt tour</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="show-hot col-sm-6">
                <h2 class="title">Tour hot {{ \Carbon\Carbon::now()->format('Y') }}</h2>
                <div class="wapper-content">
                    @foreach($tourInlandHot as $key => $tour)
                        @if($key > 0)
                            <a class="item clearfix" href="{{ $tour->getUrl() }}">
                                <div class="img pull-left"><img src="{{ $tour->getImage('sm_') }}" alt="" /></div>
                                <div class="content pull-left">{{ $tour->tou_name }}</div>
                                <i class="arrow fa fa-angle-right"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="box tour-featured col-sm-6" id="tour-foreign">
        <div class="inside row">
            <div class="show-content col-sm-6">
                <h2 class="title">Tour nước ngoài</h2>
                <div class="wapper-content">
                    @foreach($tourForeignHot as $key => $tour)
                        @if($key == 0)
                            <div class="img">
                                <a href="{{ $tour->getUrl() }}"><img src="{{ $tour->getImage('md_') }}" alt="" /></a>
                            </div>
                            <div class="tour-content">
                                <h3 class="tour-name"><a href="{{ $tour->getUrl() }}">{{ $tour->tou_name }}</a></h3>
                                <p>Thời gian: {{ $tour->getDayNight() }}</p>
                                <p class="price">Gía từ: {{ $tour->getPricePub() }}d</p>
                                <p class="discount">Gía KM: {{ $tour->getPrice() }}d</p>
                                <p>Lịch khởi hành: {{ $tour->getTourStartType() }}</p>
                                <p>Lịch trình: {{ $tour->getPlace() }}</p>
                            </div>
                            <div class="tour-detail clearfix">
                                <a href="{{ $tour->getUrl() }}" class="btn btn-default pull-left">Xem chi tiết</a>
                                <a href="{{ $tour->getUrl() }}" class="btn btn-dltl pull-right">Đặt tour</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="show-hot col-sm-6">
                <h2 class="title">Tour hot {{ \Carbon\Carbon::now()->format('Y') }}</h2>
                <div class="wapper-content">
                    @foreach($tourForeignHot as $key => $tour)
                        @if($key > 0)
                            <a class="item clearfix" href="{{ $tour->getUrl() }}">
                                <div class="img pull-left"><img src="{{ $tour->getImage('sm_') }}" alt="" /></div>
                                <div class="content pull-left">{{ $tour->tou_name }}</div>
                                <i class="arrow fa fa-angle-right"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>