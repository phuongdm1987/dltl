@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ $cplace->ctp_id > 0 ? 'Sửa' : 'Thêm mới' }} loại địa danh
		<div class="pull-right">
			<a href="javascript:window.history.back()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
		</div>
	</h3>
</div>

{{ FM::openForm() }}
	<?php
		echo Form::token();
	?>
	<div class="form-group {{ $errors->has('ctp_name') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Tên loại địa danh</label>
		<div class="col-sm-6">
			{{ Form::text('ctp_name', $cplace->ctp_name, ['class' => 'form-control', 'placeholder' => 'Nhập tên loại địa danh...']) }}
			{{ $errors->first('ctp_name', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('ctp_teaser') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Mô tả ngắn</label>
		<div class="col-sm-6">
			{{ Form::textarea('ctp_teaser', $cplace->ctp_teaser, ['class' => 'form-control']) }}
			{{ $errors->first('ctp_teaser', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-danger btn-sm"> {{ $cplace->ctp_id > 0 ? 'Cập nhật' : 'Thêm mới' }} </button>
		</div>
	</div>
{{ FM::closeForm() }}
@stop