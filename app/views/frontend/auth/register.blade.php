@extends('frontend.layouts.auth')

@section('content')
<div class="col-md-6 col-md-offset-3 register-container">
	<div class="box">
		<h2 class="text-uppercase">Đăng ký tài khoản</h2>
		{{-- <p> Bạn là chủ một cửa hàng nhỏ, hay một doanh nghiệp đang c </p> --}}
		<p class="text-muted">Nếu đã có tài khoản, hãy <a href="{{ route('auth.login') }}">đăng nhập</a> tại đây</p>
		<hr>
		{{ Form::open(['route' => 'post/register', 'role' => 'form', 'method' => 'POST', 'autocomplete' => 'off']) }}

			<div class="form-group {{ hasValidator('email') }}">
				<label for="email" >Email <b class="text-danger">*</b></label>
				{{ Form::email('email', Input::old('email'), ['id' => 'email', 'class' => 'form-control btn-flat', 'placeholder' => 'example@gmail.com']) }}
				{{ alertError('email') }}
			</div>

			<div class="form-group {{ hasValidator('fullname') }}">
				<label for="email" >Họ và tên <b class="text-danger">*</b></label>
				{{ Form::text('fullname', Input::old('fullname'), ['id' => 'fullname', 'class' => 'form-control btn-flat', 'placeholder' => 'example@gmail.com']) }}
				{{ alertError('fullname') }}
			</div>

			<div class="form-group {{ hasValidator('phone') }}">
				<label for="phone" >Số điện thoại <b class="text-danger">*</b></label>
				{{ Form::text('phone', Input::old('phone'), ['id' => 'phone', 'class' => 'form-control btn-flat', 'placeholder' => '0956xxxxxx']) }}
				{{ alertError('phone') }}
			</div>

			<div class="form-group {{ hasValidator('address') }}">
				<label for="address" >Địa chỉ</label>
				{{ Form::text('address', Input::old('address'), ['id' => 'address', 'class' => 'form-control btn-flat', 'placeholder' => '']) }}
				{{ alertError('address') }}
			</div>

			<div class="form-group {{ hasValidator('password') }}">
				<label for="key" >Mật khẩu <b class="text-danger">*</b></label>
				{{ Form::password('password', ['class' => 'form-control btn-flat', 'placeholder' => 'Nhập mật khẩu']) }}
				{{ alertError('password') }}
			</div>

			<div class="form-group {{ hasValidator('re-password') }}">
				<label for="key" >Nhập lại mật khẩu <b class="text-danger">*</b></label>
				{{ Form::password('re-password', ['class' => 'form-control btn-flat', 'placeholder' => 'Nhập mật khẩu']) }}
				{{ alertError('re-password') }}
			</div>

			<div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Đăng ký</button>
        	</div>
		{{ Form::close() }}
	</div>
</div>
@stop
