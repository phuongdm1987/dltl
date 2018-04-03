<div class="box search support">
	<div class="header">
	    <h3>Tìm tour</h3>
	    <div class="clearfix border-header">
	        <hr class="hight-line">
	        <hr class="">
	    </div>
	</div>
	<div class="wapper-content">
	   <form id="tour_search" name="tour_search" action="{{ route('search') }}" method="GET">
	   	<div class="form-group">
	   		<input type="text" class="form-control" id="tSearch" name="q" value="{{ Input::get('q') }}" placeholder="Nơi bạn muốn đến">
	   	</div>
	   	<div class="form-group">
	   		<select name="tou_start_city" class="form-control fsd-flat">
					<option value="">Điểm khởi hành</option>
					@foreach($cities as $id => $city_name)
						<option value="{{ $id }}" {{ Input::get('tou_start_city') == $id ? 'selected="selected"' : '' }}>{{ $city_name }}</option>
					@endforeach
				</select>
	   	</div>
	   	<div class="form-group row">
	   		<div class="col-sm-12">
	   			<label for="timefrom">Khoảng thời gian khởi hành:</label>
	   		</div>
    			<div class="col-sm-6">
    				<input type="text" class="form-control datepicker" id="timefrom" name="timefrom" value="{{ Input::get('timefrom') }}" placeholder="Từ">
    			</div>
    			<div class="col-sm-6">
    				<input type="text" class="form-control datepicker" id="timeto" name="timeto" value="{{ Input::get('timeto') }}" placeholder="Đến">
    			</div>
			</div>
			<div class="form-group">
				<select name="range_price" class="form-control fsd-flat" form="tour_search">
					<option value="">Chọn mức giá</option>
					<option value="1" {{ Input::get('range_price') == 1 ? 'selected="selected"' : '' }}>0-2000k</option>
					<option value="2" {{ Input::get('range_price') == 2 ? 'selected="selected"' : '' }}>2000k-4000k</option>
					<option value="3" {{ Input::get('range_price') == 3 ? 'selected="selected"' : '' }}>4000k-6000k</option>
					<option value="4" {{ Input::get('range_price') == 4 ? 'selected="selected"' : '' }}>6000k-8000k</option>
					<option value="5" {{ Input::get('range_price') == 5 ? 'selected="selected"' : '' }}>8000k-10000k</option>
					<option value="6" {{ Input::get('range_price') == 6 ? 'selected="selected"' : '' }}>Trên 10000k</option>
				</select>
			</div>
			<div class="form-group text-center">
				<input type="submit" id="submit" class="btn btn-success fsd-flat" value="Tìm">
			</div>
		</form>
	</div>
</div>

<div class="box filter support">
	<div class="header">
	    <h3>Lọc theo thời gian</h3>
	    <div class="clearfix border-header">
	        <hr class="hight-line">
	        <hr class="">
	    </div>
	</div>
	<div class="wapper-content text-center">
		<div class="btn-group">
			<button class="btn btn-primary fsd-flat" data-placeholder="Please select" data-label-placement="">{{ Input::has('day') ? Input::get('day') .' ngày' : 'Số ngày' }} </button>
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle fsd-flat"><span class="caret"></span> </button>
			<ul class="dropdown-menu noclose fsd-flat">
				@for($i = 1; $i <= 10; $i++)
					<li>
						<a href="{{ url_add_params(['day' => $i]) }}">{{ $i }} ngày</a>
					</li>
				@endfor
			</ul>
		</div>

		<div class="btn-group">
			<button class="btn btn-primary fsd-flat" data-placeholder="Please select" data-label-placement="">{{ Input::has('night') ? Input::get('night') .' đêm' : 'Số đêm' }}</button>
			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle fsd-flat"><span class="caret"></span> </button>
			<ul class="dropdown-menu noclose fsd-flat">
				@for($i = 1; $i <= 10; $i++)
					<li>
						<a href="{{ url_add_params(['night' => $i]) }}">{{ $i }} đêm</a>
					</li>
				@endfor
			</ul>
		</div>
	</div>
</div>

@if (isset($city) && isset($places) && count($places) > 0)
<div class="box goto support">
	<div class="header">
	    <h3>Điểm đến tại {{ $city->cit_name }}</h3>
	    <div class="clearfix border-header">
	        <hr class="hight-line">
	        <hr class="">
	    </div>
	</div>
	<div class="wapper-content">
		<ul class="local-goto list-unstyled">
			@if(isset($places) && count($places) > 0)
				@foreach ($places as $place)
					<li><a href="{{ $place->getUrl() }}">{{ $place->pla_name }}</a></li>
				@endforeach
			@endif
		</ul>
	</div>
</div>
@endif

<div class="box tour-interesting support">
	<div class="header">
	    <h3>Tour du lịch hấp dẫn</h3>
	    <div class="clearfix border-header">
	        <hr class="hight-line">
	        <hr class="">
	    </div>
	</div>
	<div class="wapper-content">
		<ul class="list-unstyled">
			@foreach($GLB_Tours as $toRandom)
				<li class="fsd-tour-item">
					<a href="{{ $toRandom->getUrl() }}" title="{{ $toRandom->tou_name }}">
						<img src="{{ $toRandom->getImage() }}" alt="{{ $toRandom->tou_name }}">
						<h3 class="fsd-tour-title">
							{{ $toRandom->tou_name }}
						</h3>
						<span class="fsd-tour-price price_show">
							<b>Giá: </b> {{ format_number($toRandom->tou_price) }} <sup>đ</sup>
						</span>
					</a>
				</li>
			@endforeach
		</ul>
	</div>
</div>