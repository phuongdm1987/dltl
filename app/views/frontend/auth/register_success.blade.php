@extends('frontend.layouts.auth')

@section('content')
<div class="col-md-6 col-md-offset-3 register-container">
	<div class="box">
		<div class="alert alert-success">
		Bạn đã đăng ký thành công. VnGoing đã gửi một email vào hòm thư <b>{{ $email }}</b> với nội dung kích hoạt tài khoản . 
      Vui lòng kiểm tra Email và làm theo hướng dẫn.
		<br/ ><br/>
      Cảm ơn!
		</div>
		<a href="/"><i class="fa fa-angle-right"></i> Về trang chủ</a>
	</div>
</div>
@stop
