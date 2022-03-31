@extends('dltl/layouts/account')

@section('style')
	<link href="{{ asset("assets/css/jquery.tagsinput.css") }}" media="all" rel="stylesheet">
@stop

@section('content')
<div class="header">
   <h3>{{ $tour->tou_id > 0 ? 'Cập nhật tour' : 'Thêm mới tour' }}</h3>
   <div class="clearfix border-header">
      <hr class="hight-line">
      <hr class="">
   </div>
</div>
<section class="main-body">
	<div role="tabpanel">
		{{ Form::open(['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#tour" aria-controls="tour" role="tab" data-toggle="tab">Thông tin tour</a></li>
				<li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Thông tin mở rộng</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="tour">
					<br/>
					{{--Tiêu đề tour--}}
					<div class="form-group {{ $errors->has('tou_name') ? 'has-error' : '' }}">
						<label for="tou_name" class="col-sm-3 control-label">Tên tour <b class="text-danger">*</b></label>
						<div class="col-sm-9">
							{{ Form::text('tou_name', $tour->tou_name, ['class' => 'form-control', 'id' => 'tou_name', 'placeholder' => 'Nhập tên tour của bạn']) }}
							{{ $errors->first('tou_name', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>
					@if($tour->tou_id > 0)
						<div class="form-group">
							<label for="tou_image" class="col-sm-3 control-label"></label>
							<div class="col-sm-3">
								<div class="tour-image" style="background: url('{{ $tour->getImage() }}') center center; background-size: cover; width: 50px; height: 50px;"></div>
							</div>
						</div>
					@endif

					{{--Ảnh Minh Họa--}}
					<div class="form-group {{ $errors->has('tou_image') ? 'has-error' : '' }}">
						<label for="tou_image" class="col-sm-3 control-label">Ảnh đại diện</label>
						<div class="col-sm-8">
							{{ Form::file('tou_image', ['class' => 'tou_image', 'accept' => 'image/*']) }}
							{{ $errors->first('tou_image', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>

					{{--Giá tour--}}
					<div class="form-group {{ $errors->has('tou_price') ? 'has-error' : '' }}">
						<label for="tou_price" class="col-sm-3 control-label">Giá <b class="text-danger">*</b></label>
						<div class="col-sm-6">
							<div class="input-group">
								{{ Form::text('tou_price', $tour->tou_price, ['class' => 'form-control', 'id' => 'tou_price', 'placeholder' => 'Giá tour']) }}
								<div class="input-group-addon">đ</div>
							</div>
							{{ $errors->first('tou_price', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>

					{{--Thời gian--}}
					<div class="form-group {{ $errors->has('tou_day') ? 'has-error' : '' }}  {{ $errors->has('tou_night') ? 'has-error' : '' }}">
						<label for="tou_day" class="col-sm-3 control-label"> Thời gian <b class="text-danger">*</b></label>

						{{--Số ngày--}}
						<div class="col-sm-3">
							<div class="input-group">
								{{ Form::number('tou_day', $tour->tou_day, ['class' => 'form-control', 'id' => 'tou_day', 'placeholder' => 'ngày', 'min' => '0']) }}
								<div class="input-group-addon">Ngày</div>
							</div>
							{{ $errors->first('tou_day', '<span class="help-inline text-danger">:message</span>') }}
						</div>

						{{--Số đêm--}}
						<div class="col-sm-3">
							<div class="input-group">
								{{ Form::number('tou_night', $tour->tou_night, ['class' => 'form-control', 'id' => 'tou_night', 'placeholder' => 'đêm', 'min' => '0']) }}
								<div class="input-group-addon">Đêm</div>
							</div>
							{{ $errors->first('tou_night', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>

					{{--Khởi hành--}}
					<div class="form-group">
						<label for="tou_end_time" class="col-sm-3 control-label">Khởi hành</label>
						<div class="col-sm-6">
							<div class="radio-inline">
								<label>
									@if($tour->tou_id > 0)
										<input type="radio" name="tou_start_type" id="tou_start_type_1" value="1" {{ $tour->tou_start_type == 1 ? 'checked' : ''}}>Hàng ngày
									@else
										<input type="radio" name="tou_start_type" id="tou_start_type_1" value="1" checked>Hàng ngày
									@endif
								</label>
							</div>
							<div class="radio-inline">
								<label><input type="radio" name="tou_start_type" id="tou_start_type_2" value="2" {{ $tour->tou_start_type == 2 ? 'checked' : ''}}>Hàng tuần</label>
							</div>
							<div class="radio-inline">
								<label><input type="radio" name="tou_start_type" id="tou_start_type_2" value="3" {{ $tour->tou_start_type == 3 ? 'checked' : ''}}>Lịch cố định</label>
							</div>
						</div>
					</div>

					{{--Ngày trong tuần--}}
					<div class="form-inline form-group week hide">
						<label for="week" class="col-sm-3 control-label">Ngày trong tuần</label>
						<div class="col-sm-9">
							@foreach($weeks as $key => $value)
								<label class="checkbox inline" style="margin-right: 5px;">
									@if($tour->tou_id > 0 && $tour->tou_start_type == 2)
										<input type="checkbox" id="{{ $key }}" value="{{ $key }}" name="tou_by_week[]" {{ in_array($key, $weeks_db) ? 'checked' : '' }}> {{ $value }}
									@else
										<input type="checkbox" id="{{ $key }}" value="{{ $key }}" name="tou_by_week[]"> {{ $value }}
									@endif
								</label>
							@endforeach
						</div>
					</div>
					<div class="month hide">
						<div class="form-group">
							<label for="tou_day_month" class="col-sm-3 control-label">Lịch cố định</label>
							<div class="col-sm-6">
								<input type="text" name="tou_start_time" class="form-control datepicker" value="{{ date('d/m/Y', $tour->tou_start_time) }}"/>
							</div>
						</div>
					</div>

					{{--Phân loại khu vực--}}
					<div class="form-group {{ $errors->has('tou_type') ? 'has-error' : '' }}">
						<label for="tou_type" class="col-sm-3 control-label">Phân loại khu vực <b class="text-danger">*</b></label>
						<div class="col-sm-6">
							{{ Form::select('tou_type', array_merge([0 => 'Chọn loại'], $tourTypes), $tour->tou_type, ['class' => 'form-control']) }}
							{{ $errors->first('tou_type', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>

					{{--Quốc gia và thành phố--}}
					<div class="form-group {{ $errors->has('tou_departure') ? 'has-error' : '' }}">
						<label for="tou_departure" class="col-sm-3 control-label">Điểm khởi hành <b class="text-danger">*</b></label>

						{{--Quốc gia--}}
						<div class="col-sm-3">
							<select name="tou_country_departure" class="form-control">
								@foreach($countries as $country)
									<option value="{{ $country->cou_id }}" {{ $tour->tou_country_departure ==  $country->cou_id ? 'selected="selected"' : ''}}>{{ $country->cou_name }}</option>
								@endforeach
							</select>
						</div>

						{{--Thành phố--}}
						<div class="col-sm-3">
							<select name="tou_city_departure" class="form-control" id="tou_city_departure">
								<option value="">Thành phố</option>
								@foreach($cities as $cit_id => $cit_name)
									<option value="{{ $cit_id }}" {{ $tour->tou_city_departure ==  $cit_id ? 'selected="selected"' : ''}}>{{ $cit_name }}</option>
								@endforeach
							</select>
							{{ $errors->first('tou_city_departure', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>

					<div class="form-group {{ $errors->has('tou_country_destination') ? 'has-error' : '' }}">
						<label for="tou_country_destination" class="col-sm-3 control-label">Quốc gia <b class="text-danger">*</b></label>
						{{--Quốc gia--}}
						<div class="col-sm-6">
							<select name="tou_country_destination" class="form-control">
								@foreach($countries as $country)
									<option value="{{ $country->cou_id }}" {{ $tour->tou_country_destination ==  $country->cou_id ? 'selected="selected"' : ''}}>{{ $country->cou_name }}</option>
								@endforeach
							</select>
							{{ $errors->first('tou_country_destination', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>

					{{--Địa danh đến--}}
					<div class="form-group {{ $errors->has('tou_place_destination') ? 'has-error' : '' }}">
						<label for="tou_place_destination" class="col-sm-3 control-label">Địa danh đến</label>
						{{--Quốc gia--}}
						<div class="col-sm-9">
							<input id="places" type="text" value="{{ Input::old('tou_place_destination', $tour->getPlace()) }}" name="tou_place_destination"/>
							{{ $errors->first('tou_place_destination', '<span class="help-inline text-danger">:message</span>') }}
							<p class="note text-info">*Tip: Chọn nhiều địa danh</p>
						</div>
					</div>

					{{--Địa danh đến--}}
					<div class="form-group {{ $errors->has('tou_tags') ? 'has-error' : '' }}">
						<label for="tou_tags" class="col-sm-3 control-label">Tags</label>
						{{--Quốc gia--}}
						<div class="col-sm-9">
							{{-- <input id="tags" type="text" value="" name="tou_tags" class="form-control" data-role="tagsinput"/> --}}
							<input id="tags" type="text" value="{{ Input::old('tou_tags', $tour->tou_tags) }}" name="tou_tags" class="form-control"/>
						</div>
					</div>

					{{--Phương tiện đi lại--}}
					<div class="form-group {{ $errors->has('tou_vehicle') ? 'has-error' : '' }}">
						<label for="tou_vehicle" class="col-sm-3 control-label">Phương tiện <b class="text-danger">*</b></label>
						<div class="col-sm-6">
							{{ Form::text('tou_vehicle', $tour->tou_vehicle, ['class' => 'form-control', 'id' => 'tou_vehicle', 'placeholder' => 'VD: Ôtô, Xe máy, Tàu...']) }}
							{{ $errors->first('tou_vehicle', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>
				</div>

				{{--Thông tin chung--}}
				<div role="tabpanel" class="tab-pane" id="info">
					@if($tour->tou_id > 0)
						<div class="form-group">
							<label class="col-sm-3"></label>
							<div class="col-sm-9">
								@if(isset($photos))
									@foreach($photos as $photo)
									<img src="{{ PATH_IMAGE_TOUR . $photo->tim_tour_image }}" style="height: 50px; width: 50px; display: inline-block;">
									@endforeach
								@endif
							</div>
						</div>
					@endif
					<div class="form-group {{ $errors->has('tim_tour_image') ? 'has-error' : '' }}">
						<label for="tim_tour_image" class="col-sm-3 control-label">Ảnh tour <br/>(Chọn nhiều)</label>
						<div class="col-sm-3">
							<input type="file" name="tim_tour_image[]" multiple="multiple">
							{{ $errors->first('tim_tour_image', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>
				  <div class="form-group {{ $errors->has('tco_tour_schedule') ? 'has-error' : '' }}">
						<label for="tco_tour_schedule" class="col-sm-3 control-label">Lịch trình</label>
						<div class="col-sm-9">
							{{ Form::textarea('tco_tour_schedule',  ($tour->tou_id > 0 && isset($content->tco_tour_schedule)) ? $content->tco_tour_schedule : Input::get('tco_tour_schedule'), ['class' => 'content form-control' ]) }}
							{{ $errors->first('tco_tour_schedule', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>
					{{--Mô tả--}}
					<div class="form-group {{ $errors->has('tco_tour_comprise') ? 'has-error' : '' }}">
						<label for="tco_tour_comprise" class="col-sm-3 control-label">Giá bao gồm</label>
						<div class="col-sm-9">
							{{ Form::textarea('tco_tour_comprise', ($tour->tou_id > 0 && isset($content->tco_tour_comprise)) ? $content->tco_tour_comprise : Input::get('tco_tour_comprise'), ['class' => 'content form-control', 'width' => '100%' ]) }}
							{{ $errors->first('tco_tour_comprise', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>
					{{--Mô tả--}}
					<div class="form-group {{ $errors->has('tco_tour_policies') ? 'has-error' : '' }}">
						<label for="tco_tour_policies" class="col-sm-3 control-label">Chính sách</label>
						<div class="col-sm-9">
							{{ Form::textarea('tco_tour_policies',  ($tour->tou_id > 0 && isset($content->tco_tour_policies)) ? $content->tco_tour_policies : Input::get('tco_tour_policies'), ['class' => 'content form-control' ]) }}
							{{ $errors->first('tco_tour_policies', '<span class="help-inline text-danger">:message</span>') }}
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3 pd-l-5">
					<button type="submit" class="btn btn-primary">Cập nhật</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
</section>
@stop

@section('script')
	<script src="{{ asset("assets/js/jquery.tagsinput.js") }}"></script>
	<script type="text/javascript">
		$(function() {
			$('input:radio').change(function() {
				if($(this).val() == 2){
					if($('.week').hasClass('hide')) {
						$('.week').removeClass('hide');
						$('.month').addClass('hide');
					}
				} else if ($(this).val() == 3) {
					if($('.month').hasClass('hide')) {
						$('.month').removeClass('hide');
						$('.week').addClass('hide');
					}
				} else {
					$('.week').addClass('hide');
					$('.month').addClass('hide');
				}
			});

			var type = $('input[name=tou_start_type]:checked').val();
			if (type == 2) {
				if($('.week').hasClass('hide')) {
					$('.week').removeClass('hide');
					$('.month').addClass('hide');
				}
			}else if (type == 3) {
				if($('.month').hasClass('hide')) {
					$('.month').removeClass('hide');
					$('.week').addClass('hide');
				}
			} else{
				$('.week').addClass('hide');
				$('.month').addClass('hide');
			};

			// Change địa danh
			$('#select_city').change(function() {
				var cityId = $(this).val();
				$.getJSON('/api/place/'+ cityId +'', function(data) {

					var html = '';
					$.each(data, function(i, value) {
						html += '<option value="' + value.pla_id + '">' + value.pla_name + '</option>';
					});
					$('#tou_destination').html(html);
				});
			});

			// Input tags
			$('#tags').tagsInput({
				autocomplete_url: '/api/tags/tags.json',
				autocomplete:{ selectFirst:true, width:'auto', autoFill:true},
				height: "31px",
				width: "595px",
				defaultText: "Thêm tag",
				placeholderColor: "#666"
			});

			// Places
			$('#places').tagsInput({
				autocomplete_url: '/api/tags/places.json',
				autocomplete:{ selectFirst:true, width:'250px', autoFill:true },
				height: "60px",
				width: "595px",
				defaultText: "Thêm địa danh",
				placeholderColor: "#666"
			});
		})
	</script>
@stop