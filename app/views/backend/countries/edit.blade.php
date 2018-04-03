@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ $country->cou_id > 0 ? 'Sửa' : 'Thêm mới' }} loại địa danh
		<div class="pull-right">
			<a href="javascript:window.history.back()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
		</div>
	</h3>
</div>

{{ FM::openForm() }}
	<?php
		echo Form::token();
	?>
	<div class="form-group {{ $errors->has('cou_name') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Tên quốc gia</label>
		<div class="col-sm-6">
			{{ Form::text('cou_name', $country->cou_name, ['class' => 'form-control', 'placeholder' => 'Nhập tên quốc gia...']) }}
			{{ $errors->first('cou_name', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>
   @if($country->cou_image != "")
   <div class="form-group">
      <label for="pla_image" class="col-sm-2 control-label"></label>
      <div class="col-sm-8">
         <img src="{{ PATH_IMAGE_COUNTRY . $country->cou_image }}" style="width: 150px;">
      </div>
   </div>
   @endif

   {{--Ảnh--}}
   <div class="form-group {{ $errors->has('cou_image') ? 'has-error' : '' }}">
      <label for="cou_image" class="col-sm-2 control-label">Ảnh đại diện</label>
      <div class="col-sm-6">
         <input type="file" name="cou_image">
         {{ $errors->first('cou_image', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

	<div class="form-group {{ $errors->has('cou_code') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Mã quốc gia</label>
		<div class="col-sm-6">
			{{ Form::text('cou_code', $country->cou_code, ['class' => 'form-control', 'placeholder' => 'Nhập mã quốc gia...']) }}
			{{ $errors->first('cou_code', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-danger btn-sm"> {{ $country->cou_id > 0 ? 'Cập nhật' : 'Thêm mới' }} </button>
		</div>
	</div>
{{ FM::closeForm() }}
@stop