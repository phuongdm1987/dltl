<div id="slider-image" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#slider-image" data-slide-to="0" class="active"></li>
        <li data-target="#slider-image" data-slide-to="1"></li>
        <li data-target="#slider-image" data-slide-to="2"></li>
        <li data-target="#slider-image" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <a href="#"><img src="/assets/img/01.jpg" alt="01"></a>
            {{-- <div class="carousel-caption">
                <h3>ok 01</h3>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div> --}}
        </div>
        <div class="item">
            <a href="#"><img src="/assets/img/02.jpg" alt="02"></a>
        </div>
        <div class="item">
            <a href="#"><img src="/assets/img/03.jpg" alt="03"></a>
        </div>
        <div class="item">
            <a href="#"><img src="/assets/img/04.jpg" alt="04"></a>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#slider-image" role="button" data-slide="prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#slider-image" role="button" data-slide="next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>
</div>

<div id="box-search">
    <div class="container">
        <div class="top">
            <h2 class="pull-left">Tìm kiếm tour</h2>
            <span class="btn btn-dltl btn-search domestic {{ Session::get('tour_type', Fsd\Tours\Tour::TYPE_INLAND) == Fsd\Tours\Tour::TYPE_INLAND ? 'active' : '' }}" data-value="{{ Fsd\Tours\Tour::TYPE_INLAND }}">Du lịch trong nước</span>
            <span class="btn btn-dltl btn-search foreign {{ Session::get('tour_type', Fsd\Tours\Tour::TYPE_INLAND) == Fsd\Tours\Tour::TYPE_FOREIGN ? 'active' : '' }}" data-value="{{ Fsd\Tours\Tour::TYPE_FOREIGN }}">Du lịch nước ngoài</span>
        </div>
        <div class="bottom">
            <form class="form-inline" name="tour_search" action="{{ route('search') }}" method="get">
                <div class="form-group col-sm-4">
                    <label for="location"><i class="fa fa-map-marker"></i> Địa danh</label>
                    <input type="text" class="form-control" id="location" name="q" placeholder="Nơi bạn muốn đến" value="{{ Input::get('q') }}">
                </div>
                <div class="form-group col-sm-2">
                    <label for="range_price"><i class="fa fa-usd"></i> Khoảng giá</label>
                    <select name="range_price" id="range_price" class="form-control">
                        <option value="">Chọn khoảng giá</option>
                        <option value="1" {{ Input::get('range_price') == 1 ? 'selected="selected"' : '' }}>Dưới 2 triệu</option>
                        <option value="2" {{ Input::get('range_price') == 2 ? 'selected="selected"' : '' }}>Từ 2 đến 4 triệu</option>
                        <option value="3" {{ Input::get('range_price') == 3 ? 'selected="selected"' : '' }}>Từ 4 đến 6 triệu</option>
                        <option value="4" {{ Input::get('range_price') == 4 ? 'selected="selected"' : '' }}>Từ 6 đến 8 triệu</option>
                        <option value="5" {{ Input::get('range_price') == 5 ? 'selected="selected"' : '' }}>Từ 8 đến 10 triệu</option>
                        <option value="6" {{ Input::get('range_price') == 6 ? 'selected="selected"' : '' }}>Trên 10 triệu</option>
                    </select>
                </div>
                <div class="form-group col-sm-2">
                    <label for="sdate"><i class="fa fa-calendar"></i> Ngày khởi hành</label>
                    <input type="text" class="form-control datepicker" id="sdate" name="timefrom" placeholder="Ngày khởi hành" value="{{ Input::get('timefrom') }}">
                </div>
                <div class="form-group col-sm-1">
                    <label for="number"><i class="fa fa-users"></i> Số người</label>
                    <input type="number" class="form-control" id="number" name="number">
                </div>
                <div class="form-group">
                    <label for="number">&nbsp;</label>
                    <input type="hidden" id="tour_type" name="type" value="{{ Session::get('tour_type', Fsd\Tours\Tour::TYPE_INLAND); }}" />
                    <button type="submit" class="btn btn-dltl"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
</div>