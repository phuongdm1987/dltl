@extends('dltl/layouts/account')

@section('content')
<div class="header">
   <h3>Đổi mật khẩu</h3>
   <div class="clearfix border-header">
      <hr class="hight-line">
      <hr class="">
   </div>
</div>
<section class="main-body">
	<div role="tabpanel">
		{{ Form::open(['class' => 'form-horizontal']) }}
			<section class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
				<label for="old_password" class="col-md-3 control-label">Mật khẩu hiện tại </label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="old_password" id="old_password" autofocus value="{{ Input::old('old_password') }}">
					{{ $errors->first('old_password', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</section>

			<!-- New Password -->
			<section class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password" class="col-md-3 control-label">Mật khẩu mới </label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="password" id="password" value="{{ Input::old('password') }}">
					{{ $errors->first('password', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</section>

			<!-- Confirm New Password  -->
			<section class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }}">
				<label for="password_confirm" class="col-md-3 control-label">Xác nhận mật khẩu mới </label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}">
					{{ $errors->first('password_confirm', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</section>

			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3 pd-l-5">
					<button type="submit" class="btn btn-primary"> Đổi mật khẩu</button>`
				</div>
			</div>
		{{ Form::close() }}
	</div>
</section>
@stop