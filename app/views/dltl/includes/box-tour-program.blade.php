<div class="box-inside clearfix row" id="tour-program">
    <div class="header col-sm-12">
        <h3>Chương trình du lịch</h3>
        <div class="clearfix border-header">
            <hr class="hight-line">
            <hr class="">
        </div>
    </div>
    <div class="box col-sm-6" id="domestic">
        <h2 class="title">chương trình du lịch trong nước {{ \Carbon\Carbon::now()->format('Y') }}</h2>
        <div class="wapper-content">
            @foreach($tourInlandProgram as $tour)
                <div class="item clearfix">
                    <div class="img pull-left">
                        <a href="{{ $tour->getUrl() }}"><img src="{{ $tour->getImage('md_') }}" alt="" /></a>
                    </div>
                    <div class="content pull-left">
                        <h3 class="tour-name"><a href="{{ $tour->getUrl() }}">{{ $tour->tou_name }}</a></h3>
                        <p>Thời gian: {{ $tour->getDayNight() }}</p>
                        <p class="price">Giá từ: {{ $tour->getPricePub() }}d</p>
                        <p class="discount">Giá KM: {{ $tour->getPrice() }}d</p>
                        <p>Lịch khởi hành: {{ $tour->getTourStartType() }}</p>
                        <p>Lịch trình: {{ $tour->getPlace() }}</p>
                        <div class="detail clearfix">
                            <a href="{{ $tour->getUrl() }}" class="btn btn-default">Chi tiết</a>
                            <a href="{{ $tour->getUrl() }}" class="btn btn-dltl">Đặt tour</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="box col-sm-6" id="foreign">
        <h2 class="title">chương trình du lịch nước ngoài {{ \Carbon\Carbon::now()->format('Y') }}</h2>
        <div class="wapper-content">
            @foreach($tourForeignProgram as $tour)
                <div class="item clearfix">
                    <div class="img pull-left">
                        <a href="{{ $tour->getUrl() }}"><img src="{{ $tour->getImage() }}" alt="" /></a>
                    </div>
                    <div class="content pull-left">
                        <h3 class="tour-name"><a href="{{ $tour->getUrl() }}">{{ $tour->tou_name }}</a></h3>
                        <p>Thời gian: {{ $tour->getDayNight() }}</p>
                        <p class="price">Giá từ: {{ $tour->getPricePub() }}d</p>
                        <p class="discount">Giá KM: {{ $tour->getPrice() }}d</p>
                        <p>Lịch khởi hành: {{ $tour->getTourStartType() }}</p>
                        <p>Lịch trình: {{ $tour->getPlace() }}</p>
                        <div class="detail clearfix">
                            <a href="{{ $tour->getUrl() }}" class="btn btn-default">Chi tiết</a>
                            <a href="{{ $tour->getUrl() }}" class="btn btn-dltl">Đặt tour</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>