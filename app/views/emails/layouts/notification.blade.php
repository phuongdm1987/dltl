<!DOCTYPE HTML>
<html lang="en-US">
<head>
		<title>Thông báo từ {{ SITE_NAME }}</title>
		<meta charset="utf-8">
</head>
<body style="padding:0px;margin:0px">
	<table style="font-family:arial; font-size:13px; color:#555; line-height:1.4em; background:#e4e4e4; padding:0px 20px;" border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
	<!-- <tr>
		<td style="font-size:11px;" align="center">
			Bạn không xem được hình ảnh? <a href="#" style="color:#00aeef;text-decoration:none;">click vào đây.</a>
		</td>
	</tr> -->
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f4f4" width="620" style="font-family:arial; font-size:12px; line-height:1.4em;">
					<tbody>
					 <!-- Header -->
					 	<tr>
							<td style="padding: 15px;">
								<a href="{{ url() }}" style="display:block">
									<img src="{{ url() }}/assets/img/logo.png" alt="{{ SITE_NAME }}" width="214px">
								</a>
							</td>
					 	</tr>
						<!-- Banner Top -->
						@yield('content')
						<!-- Footer -->
						<tr>
							<td>
								<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f4f4" width="620" style="font-family:arial; font-size:13px; color:#555; line-height:1.4em; padding:0px 20px 10px 20px;">
									<tbody>
										<tr>
											<td></td>
										</tr>
										<tr>
											<td style="padding:8px 0px; vertical-align:top; text-align:center;">
											 <strong>{{ SITE_NAME }} © {{ date('d-m-Y') }}</strong>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
