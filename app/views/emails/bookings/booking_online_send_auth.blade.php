@extends('emails/layouts/notification')

@section('content')
	<tr>
		<td style="font-weight:bold; font-size:18px; padding:20px 0px; background-color: #fff;" align="center">Bạn có đơn đặt tour tại {{ SITE_NAME }}</td>
	</tr>
	<tr>
		<td style="background-color: #fff; padding: 0 25px;">
			<p style="margin:0px 0px 10px 0px">Chào <strong> {{ $user->fullName() }},</strong></p>
			<p style="margin:0px 0px 10px 0px">
				Bạn có đơn đặt tour tại {{ SITE_NAME }}. Bạn vui lòng <a href="{{ route('auth.login') }}"> Đăng nhập </a> để xác nhận booking với khách hàng.
			</p>
			<p style="margin:0px;font-style:italic">
				Cám ơn {{ $user->fullName() }}!
			</p>
		</td>
	</tr>
@stop