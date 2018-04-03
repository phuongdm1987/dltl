<div class="box_search_left">
	<div class="box_title mytour_title">
		<h2 title="Tìm tour">Tìm tour</h2>
	</div>
	<div class="box_left_item_container">
	<form id="tour_search" style="position: relative;" name="tour_search" action="{{ route('search') }}" method="GET">
		<div class="form_item">
			<input type="text" name="q" id="tSearch" class="text_search ui-autocomplete-input" placeholder="Bạn muốn đi du lịch ở đâu?" value="{{ Input::get('q') }}" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
		</div>
		<div class="form_item">
			<select name="tou_start_city" class="form-control fsd-flat">
				<option value="">Điểm khởi hành</option>
				@foreach($cities as $id => $city_name)
					<option value="{{ $id }}" {{ Input::get('tou_start_city') == $id ? 'selected="selected"' : '' }}>{{ $city_name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form_item fsd-flat">
			<p>Khoảng thời gian khởi hành:</p>
			<input type="text" name="timefrom" value="{{ Input::get('timefrom') }}" class="fsd-flat select_date date_start time_box width_112 datepicker" place="Thời gian từ">
			<input type="text" name="timeto" value="{{ Input::get('timeto') }}" class="fsd-flat select_date date_end time_box width_112 datepicker" place="đến">
		</div>
		<div class="form_item">
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
		<div class="form_item">
			<input type="submit" id="submit" class="btn btn-sm btn-success fsd-flat" value="Tìm">
		</div>
	</form>
	</div>
	<div class="clear"></div>
</div>

<div class="box_search_left margin-top-10">
	<div class="box_title mytour_title">
		<h2 title="Tìm tour">Lọc theo thời gian</h2>
	</div>
	<div class="main-body text-center" style="padding: 30px 0px;">
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

@if($topTourHotNew->count() > 0)
	<section id="fsd-tour-listing">
		<ul>
			<li class="fsd-first">
				Tour du lịch HOT
			</li>
			@foreach($topTourHotNew as $tour)
				<li class="fsd-tour-item">
					<a href="{{ $tour->getUrl() }}" title="{{ $tour->tou_name }}">
						<img src="{{ $tour->getImage() }}" alt="{{ $tour->tou_name }}">
						<h3 class="fsd-tour-title">
							@if($tour->tou_hot == 1)
								<i style="background: url({{ asset('/assets/img/icon-hot.gif') }}) no-repeat 0px 1px; height: 18px; width: 52px; display: inline-block;"></i>
							@endif
							{{ $tour->tou_name }}
						</h3>
						<span class="fsd-tour-price price_show">
							<b>Giá: </b> {{ format_number($tour->tou_price) }} <sup>đ</sup>
						</span>
					</a>
				</li>
			@endforeach
		</ul>
	</section>
@endif