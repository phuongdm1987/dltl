@extends('dltl/layouts/account')

@section('content')
<div class="header">
   <h3>Thông tin cá nhân</h3>
   <div class="clearfix border-header">
      <hr class="hight-line">
      <hr class="">
   </div>
</div>
<section class="main-body">
	<div role="tabpanel">
		{{ Form::open(['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
			<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
				<label for="fullname" class="col-sm-3 control-label">Họ tên <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					{{ Form::text('fullname', $user->fullname, ['class' => 'form-control', 'id' => 'fullname', 'placeholder' => 'Nhập tên họ tên của bạn']) }}
					{{ $errors->first('fullname', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</div>

			@if($user->avatar != null)
				<div class="form-group">
					<label for="tou_image" class="col-sm-3 control-label"></label>
					<div class="col-sm-2">
						<div class="tour-image" style="background: url('{{ $user->getPictureAvatar() }}') center center; background-size: cover; width: 80px; height: 80px; border: 1px solid #f5f5f5;"></div>
					</div>
				</div>
			@endif

			{{--Ảnh Minh Họa--}}
			<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
				<label for="avatar" class="col-sm-3 control-label">Avatar</label>
				<div class="col-sm-8">
					{{ Form::file('avatar', ['class' => 'avatar', 'accept' => 'image/*']) }}
					{{ $errors->first('avatar', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</div>

			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				<label for="email" class="col-sm-3 control-label">Email <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					{{ Form::email('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Nhập tên email của bạn']) }}
					{{ $errors->first('email', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</div>

			<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
				<label for="phone" class="col-sm-3 control-label"> Số điện thoại </label>
				<div class="col-sm-6">
					{{ Form::text('phone', $user->phone, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Số điện thoại của bạn']) }}
					{{ $errors->first('phone', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</div>

			<div class="form-group {{ $errors->has('bank_account') ? 'has-error' : '' }}">
				<label for="bank_account" class="col-sm-3 control-label">Tài khoản ngân hàng</label>
				<div class="col-sm-6">
					{{ Form::text('bank_account', $user->bank_account, ['class' => 'form-control', 'id' => 'bank_account', 'placeholder' => 'Nhập tài khoản ngân hàng của bạn']) }}
					{{ $errors->first('bank_account', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</div>

			<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
				<label for="address" class="col-sm-3 control-label"> Địa chỉ</label>
				<div class="col-sm-6">
					{{ Form::textarea('address', $user->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Nhập địa chỉ của bạn', 'rows' => '3x3']) }}
					{{ $errors->first('address', '<span class="help-inline text-danger">:message</span>') }}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3 pd-l-5">
					<button type="submit" class="btn btn-primary">Cập nhật</button>
					<a href="{{ route('profile.changepassword') }}" class="link fsd-link">Đổi mật khẩu</a>
				</div>
			</div>
		{{ Form::close() }}
	</div>
</section>
@stop