@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ $post->post_id > 0 ? 'Sửa' : 'Thêm mới' }} bài viết
		<div class="pull-right">
			<a href="javascript:window.history.back()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
		</div>
	</h3>
</div>

{{ FM::openForm() }}
	<?php
		echo Form::token();
	?>
	<div class="form-group {{ $errors->has('pos_title') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Tiêu đề</label>
		<div class="col-sm-6">
			{{ Form::text('pos_title', $post->pos_title, ['class' => 'form-control', 'placeholder' => 'VD: 6 tuyệt chiêu bán hàng qua mạng...']) }}
			{{ $errors->first('pos_title', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('pos_icon') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Icon</label>
		<div class="col-sm-6">
			{{ Form::text('pos_icon', $post->pos_icon, ['class' => 'form-control', 'placeholder' => 'VD: fa fa-book']) }}
			{{ $errors->first('pos_icon', '<span class="help-inline text-danger">:message</span>') }}
			<div>Support <a href="http://getbootstrap.com/components/#glyphicons" target="_blank">Bootstrap</a> &amp; <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Fontawesome</a> icons</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Danh mục</label>
		<div class="col-sm-6 {{ $errors->has('category_id') ? 'has-error' : '' }}">
			<select name="category_id" id="parents" class="form-control">
					<option value="0">-- Chọn danh mục cha --</option>
						@foreach ($categories as $category)
							@if($category->type == 3)
								<option value="{{ $category->id }}" {{ $category->id == $post->pos_category_id ? 'selected' : '' }}>
									@for ($i = 0; $i < $category->level; $i++)
										{{ ($i == 0 ? '|' : '') . '&rarr;' }}
									@endfor
									{{ $category->name }}
								</option>
							@endif
						@endforeach
				</select>

				{{ $errors->first('category_id', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('pos_image') ? 'has-error' : ''}}">
		<label class="control-label col-sm-2" for="cat_color">Ảnh minh họa</label>
		<div class="col-sm-6">
			<?php
				if($post->pos_image) {
					echo FM::makeControl('', FM::image(['src' => $post->getPicture('sm_')]));
				}
			?>
			{{ Form::file('pos_image', null, ['class' => 'pos_image']) }}

			{{ $errors->first('pos_image', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('pos_teaser') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Mô tả ngắn</label>
		<div class="col-sm-10">
			{{ Form::textarea('pos_teaser', $post->pos_teaser, ['class' => 'content']) }}
			{{ $errors->first('pos_teaser', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group {{ $errors->has('pos_content') ? 'has-error' : '' }}">
		<label class="col-sm-2 control-label">Nội dung</label>
		<div class="col-sm-10">
			{{ Form::textarea('pos_content', $post->pos_content, ['class' => 'content']) }}
			{{ $errors->first('pos_content', '<span class="help-inline text-danger">:message</span>') }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-danger btn-sm"> Đăng bài</button>
		</div>
	</div>
{{ FM::closeForm() }}
@stop