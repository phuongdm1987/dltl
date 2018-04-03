@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ $testimonial->tes_id > 0 ? 'Sửa' : 'Thêm mới' }} ý kiến khách hàng
		<div class="pull-right">
			<a href="javascript:window.history.back()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
		</div>
	</h3>
</div>

{{ FM::openForm() }}
	<?php
		echo Form::token();
	?>
	<div class="form-group {{ $errors->has('tes_fullname') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Họ tên</label>
		<div class="col-sm-6">
			{{ Form::text('tes_fullname', $testimonial->tes_fullname, ['class' => 'form-control']) }}
			{{ $errors->first('tes_fullname', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('tes_store') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Cửa hàng</label>
		<div class="col-sm-6">
			{{ Form::text('tes_store', $testimonial->tes_store, ['class' => 'form-control']) }}
			{{ $errors->first('tes_store', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('pos_image') ? 'has-error' : ''}}">
		<label class="control-label col-sm-2" for="cat_color">Ảnh minh họa</label>
		<div class="col-sm-6">
			<?php
				if($testimonial->tes_image) {
					echo FM::makeControl('', FM::image(['src' => $testimonial->getPicture('sm_')]));
				}
			?>
			{{ Form::file('tes_image', null, ['class' => 'tes_image']) }}

			{{ $errors->first('tes_image', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('pos_content') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Nội dung</label>
		<div class="col-sm-10">
			{{ Form::textarea('tes_content', $testimonial->tes_content, ['class' => 'content']) }}
			{{ $errors->first('tes_content', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary btn-sm"> Thêm mới</button>
		</div>
	</div>
{{ FM::closeForm() }}
@stop