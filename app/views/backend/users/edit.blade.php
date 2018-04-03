@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Cập nhật thông tin tài khoản quản trị::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="container">
	<div class="page-header">
		<h3>
			Cập nhật thông tin tài khoản quản trị
			<div class="pull-right">
				<a href="{{ route('users') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> trở lại</a>
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
				<!-- First Name -->
				<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="fullname">Họ và tên</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="fullname" id="fullname" value="{{ Input::old('fullname', $user->fullname) }}" />
						{{ $errors->first('fullname', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Email -->
				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="email">Email</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email', $user->email) }}" />
						{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Password -->
				<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="password">Mật khẩu</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="password" id="password" value="" />
						{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Password Confirm -->
				<div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="password_confirm">Xác nhận mật khẩu</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
						{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

				<!-- Activation Status -->
				<div class="form-group {{ $errors->has('activated') ? 'has-error' : '' }}">
					<label class="control-label col-sm-2" for="activated">Kích hoạt</label>
					<div class="col-sm-6">
						<select{{ ($user->id === $GLB_Login->getId() ? ' disabled="disabled"' : '') }} name="activated" id="activated">
							<option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
							<option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.no')</option>
						</select>
						{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
					</div>
				</div>

			</div>

			<!-- Permissions tab -->
			<div class="tab-pane" id="tab-permissions">
				@foreach ($permissions as $perItem)
				<fieldset>
					<legend>{{ $perItem['label'] }}</legend>

					@foreach ($perItem['permissions'] as $permission)
					<div class="form-group col-sm-3">
						<label class="control-label">{{ $permission['display_name'] }}</label>

						<div class="radio inline">
							<label for="{{ $permission['name'] }}_allow" onclick="">
								<input type="radio" value="1" id="{{ $permission['name'] }}_allow" name="permissions[{{ $permission['name'] }}]" {{ array_key_exists($permission['name'], $userPermissions) && $userPermissions[$permission['name']] == 1 ? 'checked="checked"' : '' }}>
								Cho phép
							</label>
						</div>

						<div class="radio inline">
							<label for="{{ $permission['name'] }}_deny" onclick="">
								<input type="radio" value="0" id="{{ $permission['name'] }}_deny" name="permissions[{{ $permission['name'] }}]" {{ array_key_exists($permission['name'], $userPermissions) && $userPermissions[$permission['name']] == 0 ? 'checked="checked"' : '' }}>
								Cấm
							</label>
						</div>

					</div>
					@endforeach

				</fieldset>
				@endforeach
			</div>
		</div>

		<p class="clearfix"></p>
		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<a class="btn btn-link" href="{{ route('users') }}">Hủy</a>

				<button type="reset" class="btn">Xóa dữ liệu</button>

				<button type="submit" class="btn btn-success">Cập nhật</button>
			</div>
		</div>
	</form>
</div>
@stop
