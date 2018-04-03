@extends('dltl/layouts/master')

@section('content')
    <div class="">
        <div class="container" id="body-content">
            {{-- main content --}}
            <div class="box-wapper row">
                <div class="col-sm-9" id="main-content">
                	<div class="box-inside clearfix" id="tour-detail">
                        @include ('frontend/breadcrumbs')
					    <div class="box" id="domestic">
					    	<h1 class="title">{{ $tour->tou_name }}</h1>
                            <div class="tour-content">
                                <div class="tour-header clearfix">
                                    <div class="img pull-left">
                                        <img src="{{ $tour->getImage('md_') }}" alt="{{ $tour->tou_name }}">
                                    </div>
                                    <div class="content pull-left">
                                        <p>Điểm khởi hành: {{ $tour->city->cit_name }}</p>
                                        <p>Thời gian: {{ $tour->getDayNight() }}</p>
                                        <p>Giá tour: {{ $tour->getPricePub() }}</p>
                                        <p class="discount">Giá KM : {{ $tour->getPrice() }}</p>
                                        <p>Phương tiện: {{ $tour->tou_vehicle }}</p>
                                    </div>
                                </div>
                                @if(count($photos) > 0)
                                    <div class="slider-img carousel slide" id="myCarousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @foreach($photos as $key => $photo)
                                                <?php $key += 1 ?>
                                                @if($key % 3 == 0 || $key == count($photos))
                                                <?php $index = $key - 3 >= 0 ? $key - 3 : 0 ?>
                                                    <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="{{ $key == 3 || ($key < 3 && $key == count($photos)) ? 'active' : '' }}"></li>
                                                @endif
                                            @endforeach
                                        </ol>

                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            @foreach($photos as $key => $photo)
                                            <?php $key += 1 ?>
                                                @if($key % 3 == 0 || $key == count($photos))
                                                <div class="item {{ $key == 3 || ($key < 3 && $key == count($photos)) ? 'active' : '' }}">
                                                    <div class="row">
                                                        @for($max = $key; $max >= ($key - 2); $max--)
                                                        <div class="col-sm-4 item-inside">
                                                            @if($max < 1)
                                                                <img src="http://placehold.it/280x150" alt="">
                                                            @else
                                                                <img src="{{ PATH_IMAGE_TOUR . 'md_' . $photos[$max-1]->tim_tour_image }}" alt="{{ $tour->tou_name }}">
                                                            @endif
                                                        </div>
                                                        @endfor
                                                    </div>
                                                    <!--/row-->
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <!--/myCarousel-->
                                    </div>
                                @endif
                                <div class="schedule data-content">
                                    <div class="header">
                                        <h4>Lịch trình</h4>
                                        <div class="clearfix border-header">
                                            <hr class="">
                                        </div>
                                    </div>
                                    <div class="data">{{ $content->tco_tour_schedule }}</div>
                                </div>
                                <div class="comprise data-content">
                                    <div class="header">
                                        <h4>Giá bao gồm</h4>
                                        <div class="clearfix border-header">
                                            <hr class="">
                                        </div>
                                    </div>
                                    <div class="data">{{ $content->tco_tour_comprise }}</div>
                                </div>
                                <div class="policies data-content">
                                    <div class="header">
                                        <h4>Chính sách</h4>
                                        <div class="clearfix border-header">
                                            <hr class="">
                                        </div>
                                    </div>
                                    <div class="data">{{ $content->tco_tour_policies }}</div>
                                </div>
                            </div>
					    </div>

                        <div class="header">
                            <h3>Đặt tour</h3>
                            <div class="clearfix border-header">
                                <hr class="hight-line">
                                <hr class="">
                            </div>
                        </div>
                        <div class="book-tour">
                            <form id="booking" action="{{ route('tour.booking.create') }}" method="post" class="form-horizontal">
                                <div class="wapper-info clearfix">
                                    <div class="info-customer pull-left">
                                        <div class="title">Thông tin khách hàng</div>
                                        <div class="content">
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label for="name" class="col-sm-5 control-label">Họ tên *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Tên của bạn" value="{{ Request::old('name') }}">
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                <label for="address" class="col-sm-5 control-label">Địa chỉ *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ của bạn" value="{{ Request::old('address') }}">
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                <label for="phone" class="col-sm-5 control-label">Số điện thoại *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại" value="{{ Request::old('phone') }}">
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label for="email" class="col-sm-5 control-label">Email *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Địa chỉ email của bạn" value="{{ Request::old('email') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-tour pull-left">
                                        <div class="title">Thông tin tour</div>
                                        <div class="content">
                                            <div class="form-group {{ $errors->has('time_departure') ? 'has-error' : '' }}">
                                                <label for="time_departure" class="col-sm-5 control-label">Ngày khời hành *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <input type="text" class="form-control datepicker" name="time_departure" id="time_departure" placeholder="Ngày khời hành" value="{{ Request::old('time_departure') }}">
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                                <label for="quantity" class="col-sm-5 control-label">Số phiếu *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Số phiếu" value="{{ Request::old('quantity') }}">
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                                <label for="note" class="col-sm-5 control-label">Ghi chú *</label>
                                                <div class="col-sm-7 wapper-input">
                                                    <textarea class="form-control" name="note" id="phone">{{ Request::old('note') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-payment">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="tourID" value="{{ $tour->tou_id }}" />
                                    <button class="btn btn-dltl" type="submit">Đặt tour</button>
                                </div>

                            </form>
                        </div>
                	</div>
                </div>
                <div class="col-sm-3" id="aside">
                    @include('dltl/includes/tour/tour-right')
                </div>
            </div>
        </div>
    </div>
@stop