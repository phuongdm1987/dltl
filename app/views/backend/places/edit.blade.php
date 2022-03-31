@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
	Sửa địa danh ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<div class="page-header">
		<h3>
			Sửa địa danh
			<div class="pull-right">
				<a href="{{ route('place.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
			</div>
		</h3>
	</div>

	{{ FM::openForm() }}
	<?php echo Form::token();?>
		<div class="form-group {{ $errors->has('pla_name') ? 'has-error' : '' }}">
			<label for="pla_name" class="col-sm-3 control-label">Tên địa danh</label>
			<div class="col-sm-6">
				{{ Form::text('pla_name', $place->pla_name, ['class' => 'form-control', 'id' => 'pla_name', 'placeholder' => 'Nhập tên địa danh']) }}
				{{ $errors->first('pla_name', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			<label for="pla_image" class="col-sm-3 control-label"></label>
			<div class="col-sm-9">
				@if(isset($pladeImages))
					@foreach($pladeImages as $photo)
						<a class="tour-photo fancybox" style="background: url('{{ PATH_IMAGE_PLACE . $photo->pim_image }}') center center; background-size: cover; height: 50px; width: 50px; display: inline-block;"></a>
					@endforeach
				@endif
			</div>
		</div>

		{{--Ảnh địa danh--}}
		<div class="form-group {{ $errors->has('pla_image') ? 'has-error' : '' }}">
			<label for="pla_image" class="col-sm-3 control-label">Ảnh địa danh (chọn nhiều)</label>
			<div class="col-sm-8">
				<input type="file" name="pla_image[]" multiple="multiple">
				{{ $errors->first('pla_image', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		{{--Phân loại khu vực--}}
		<div class="form-group {{ $errors->has('pla_sector') ? 'has-error' : '' }}">
			<label for="pla_sector" class="col-sm-3 control-label">Phân loại khu vực <b class="text-danger">*</b></label>
			<div class="col-sm-3">
				{{ Form::select('pla_sector', $tourTypes, $place->pla_sector, ['class' => 'form-control']) }}
				{{ $errors->first('pla_sector', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group {{ $errors->has('pla_country_id') ? 'has-error' : '' }}">
			<label for="pla_country_id" class="col-sm-3 control-label">Quốc gia</label>
			<div class="col-sm-3">
				<select name="pla_country_id" class="form-control">
					@foreach($countries as $country)
						<option value="{{ $country->cou_id }}" {{  $place->pla_country_id == $country->cou_id ? 'selected="selected"' : '' }}>{{ $country->cou_name }}</option>
					@endforeach
				</select>
				{{ $errors->first('pla_country_id', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group {{ $errors->has('pla_type') ? 'has-error' : '' }}">
			<label for="pla_type" class="col-sm-3 control-label">Loại địa danh</label>
			<div class="col-sm-3">
				<select name="pla_type" class="form-control">
					<option value="">Chọn loại địa danh</option>
					@foreach($cplaces as $cplace)
						<option value="{{ $cplace->ctp_id }}" {{  $place->pla_type == $cplace->ctp_id ? 'selected="selected"' : '' }}>{{ $cplace->ctp_name }}</option>
					@endforeach
				</select>
				{{ $errors->first('pla_type', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		{{--Thành phố--}}
		<div class="form-group {{ $errors->has('pla_city_id') ? 'has-error' : '' }}">
			<label for="pla_city_id" class="col-sm-3 control-label">Thành phố</label>
			<div class="col-sm-3">
				<select name="pla_city_id" class="form-control" id="pla_city_id">
					<option value="">Lựa chọn thành phố</option>
					@foreach($cities as $cit_id => $cit_name)
						<option value="{{ $cit_id }}" {{ $place->pla_city_id == $cit_id ? 'selected="selected"' : '' }}>{{ $cit_name }}</option>
					@endforeach
				</select>
				{{ $errors->first('pla_city_id', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		{{--Quận huyện--}}
		<div class="form-group {{ $errors->has('pla_district_id') ? 'has-error' : '' }}">
			<label for="pla_district_id" class="col-sm-3 control-label">Quận huyện</label>
			<div class="col-sm-3">
				<select name="pla_district_id" class="form-control" id="pla_district_id">
					<option value="">Lựa chọn quận huyện</option>
					@foreach($districts as $district)
						<option value="{{ $district->cit_id }}" {{  $place->pla_district_id == $district->cit_id ? 'selected="selected"' : '' }}>{{ $district->cit_name }}</option>
					@endforeach
				<select>
				{{ $errors->first('pla_district_id', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group {{ $errors->has('pla_longitude') ? 'has-error' : '' }}">
			<label for="pla_longitude" class="col-sm-3 control-label">Kinh Độ</label>
			<div class="col-sm-3">
				{{ Form::text('pla_longitude', $place->pla_longitude, ['class' => 'form-control', 'id' => 'pla_longitude', 'placeholder' => 'Nhập kinh độ trên google maps']) }}
				{{ $errors->first('pla_longitude', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group {{ $errors->has('pla_latitude') ? 'has-error' : '' }}">
			<label for="pla_latitude" class="col-sm-3 control-label">Vĩ độ</label>
			<div class="col-sm-3">
				{{ Form::text('pla_latitude', $place->pla_latitude, ['class' => 'form-control', 'id' => 'pla_latitude', 'placeholder' => 'Nhập vĩ độ trên google maps']) }}
				{{ $errors->first('pla_latitude', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group {{ $errors->has('pla_content') ? 'has-error' : '' }}">
			<label for="" class="col-sm-3 control-label">Nội dung</label>
			<div class="col-sm-6">
				{{ Form::textarea('pla_content', $place->pla_content, ['class' => 'form-control content', 'id' => 'pla_content', 'placeholder' => 'Nhập thông tin mô tả về địa danh']) }}
				{{ $errors->first('pla_content', '<span class="help-inline text-danger">:message</span>') }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button type="submit" class="btn btn-default btn-primary">Cập nhật</button>
			</div>
		</div>
	{{ FM::closeForm() }}
@stop

@section('scripts')
	<script type="text/javascript">
		$('#pla_city_id').change(function() {
			var cityId = $(this).val();

			$.getJSON('/api/city/'+ cityId +'', function(data) {

				var html = '';
				$.each(data, function(i, value) {
					html += '<option value="' + value.cit_id + '">' + value.cit_name + '</option>';
				});
				$('#pla_district_id').html(html);
			});
		});
	</script>
@stop