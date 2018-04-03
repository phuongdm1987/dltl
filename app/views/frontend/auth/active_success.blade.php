@extends('frontend.layouts.auth')

@section('content')
<div class="col-md-6 col-md-offset-3 register-container">
   <div class="box">
      <div class="alert alert-success">
      Kích hoạt thành công tài khoản <b>{{ $email }}.</b><br/>
      Bạn có thể đăng nhập ngay <a href="{{ route('auth.login') }}">tại đây</a>
      </div>
      <a href="/"><i class="fa fa-angle-right"></i> Về trang chủ</a>
   </div>
</div>
@stop
