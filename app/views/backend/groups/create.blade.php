@extends('backend/layouts/iframe')

{{-- Web site Title --}}
@section('title')
Thêm mới nhóm quản trị ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Tạo 1 nhóm quản trị mới

		<div class="pull-right">
			<a href="{{ route('groups') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> trở lại</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">Chung</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">Phân quyền</a></li>
</ul>
<p class="clearfix"></p>
<form class="form-horizontal" method="post" action="" autocomplete="off" role="form">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<div class="form-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label col-sm-1" for="name">Tên nhóm</label>
				<div class="col-sm-6">
					<input class="form-control col-sm-3" type="text" name="name" id="name" value="{{ Input::old('name') }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>

		<!-- Tab Permissions -->
		<div class="tab-pane" id="tab-permissions">
			@foreach ($permissions as $area => $permissions)
			<fieldset>
				<legend>{{ $area }}</legend>

				@foreach ($permissions as $permission)
				<div class="form-group col-sm-3">
					<label class="control-label">{{ $permission['label'] }}</label>

					<div class="radio">
						<label for="{{ $permission['permission'] }}_allow" onclick="">
							<input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
							Cho phép
						</label>
					</div>

					<div class="radio">
						<label for="{{ $permission['permission'] }}_deny" onclick="">
							<input type="radio" value="0" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
							Cấm
						</label>
					</div>
				</div>
				@endforeach

			</fieldset>
			@endforeach
		</div>
	</div>

	<!-- Form Actions -->
	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-6">
			<a class="btn btn-link" href="{{ route('groups') }}">Hủy</a>

			<button type="reset" class="btn">Xóa dữ liệu</button>

			<button type="submit" class="btn btn-success">Tạo mới</button>
		</div>
	</div>
</form>
@stop
