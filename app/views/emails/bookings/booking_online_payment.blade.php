@extends('emails/layouts/notification')

@section('content')
	<tr>
		<td style="font-weight:bold; font-size:18px; padding:20px 0px; background-color: #fff;" align="center">Xác nhận thanh toán thành công</td>
	</tr>
	<tr>
		<td style="background-color: #fff; padding: 0 25px;">
			<p style="margin:0px 0px 10px 0px">Chào <strong> {{ $booking->getCustomerName() }},</strong></p>
			<p style="margin:0px 0px 10px 0px">Cám ơn quí khách đã đặt dịch vụ của <b> {{ $user->fullName() }} </b> qua hệ thống {{ SITE_NAME }}.</p>
			<p style="margin:0px 0px 10px 0px">
				{{ $user->fullName() }} xác nhận đã nhận được thanh toán của quí khách. <br/>
				Mọi vấn đề thắc mắc cần được giải đáp quí khách có thể liên hệ với {{ $user->fullName() }} theo số :  {{ $user->phone }} </p></br/>
				Hoặc {{ SITE_NAME }} qua Hotline 0963267620 để được hỗ trợ.
			</p>
			<p style="margin:0px 0px 10px 0px">Chúc quý khách có một chuyến đi vui vẻ!</p>
		</td>
	</tr>
	<tr>
		<td>
			<table style="font-size:13px;color:#555;line-height:20px;padding:20px" align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="620">
				<tbody>
					<tr>
						<td>
							<table style="font-size:13px;color:#555;line-height:20px" align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody>
									<tr>
										<td colspan="2" style="border:1px solid #e3e3e3;background:#f7f7f7;padding:10px">
											Mã đặt tour: <strong style="font-size:14px;font-weight:bold;color:#5babef">{{ $booking->boo_code }}</strong>
										</td>
									</tr>
									<tr>
										<td style="border-left:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;padding:10px;width:50%;vertical-align:top">
											<table style="font-size:13px;color:#555;padding-bottom:30px;line-height:20px" align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th style="padding-bottom:8px;text-transform:uppercase;text-align:left;border-bottom:1px solid #e3e3e3" colspan="2">
															Thông tin đặt tour
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Ngày tạo
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;font-weight:bold">
															{{ date('d-m-Y h:i:s', $booking->boo_create_time) }}
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Ngày khởi hành
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;font-weight:bold;color:#be564d">
															{{ date('d-m-Y h:i:s', $booking->boo_time_departure) }}
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Điểm khởi hành:
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3">
															{{ $tour->city->cit_name }}
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Điểm đến:
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3">
															{{ $tour->tou_place_destination }}
														</td>
													</tr>
												</tbody>
											</table>
											<table style="font-size:13px;color:#555;line-height:20px" align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th style="padding-bottom:8px;text-transform:uppercase;text-align:left;border-bottom:1px solid #e3e3e3" colspan="2">
															Thông tin khách hàng
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Khách hàng:
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;font-weight:bold">
															{{ $booking->getCustomerName() }}
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Địa chỉ:
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3">
															{{ $booking->getCustomerAddress() }}
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3;width:90px">
															Điện thoại:
														</td>
														<td style="padding:8px 0px;vertical-align:top;border-bottom:1px solid #e3e3e3">
															{{ $booking->getCustomerPhone() }}
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px;vertical-align:top;width:90px">
															Email:
														</td>
														<td style="padding:8px 0px;vertical-align:top">
															<a href="mailto:{{ $booking->getCustomerEmail() }}" target="_blank">{{ $booking->getCustomerEmail() }}</a>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td style="border-right:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;padding:10px;vertical-align:top;width:50%">
											<table style="font-size:13px;color:#555;line-height:20px" align="center" bgcolor="#f7f7f7" border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th style="padding-bottom:8px;text-transform:uppercase;text-align:left;border-bottom:1px solid #e3e3e3;background:#ffffff" colspan="2">
															Thông tin thanh toán
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="padding:8px 0px 8px 8px;vertical-align:top;border-left:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;width:140px">
															<strong>{{ $tour->tou_name }}</strong>
														</td>
														<td style="padding:8px;vertical-align:top;border-right:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;font-weight:bold;text-align:right">
															<strong style="color:#4d8337">{{ format_number($booking->boo_tour_price) }} <sup>đ</sup></strong>
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px 8px 8px;vertical-align:top;border-left:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;width:140px">
															Số phiếu:
														</td>
														<td style="padding:8px;vertical-align:top;border-right:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;font-weight:bold;text-align:right">
															<strong>{{ $booking->boo_quantity }}</strong>
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px 8px 8px;vertical-align:top;border-left:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;width:140px">
															Tổng số tiền :
														</td>
														<td style="padding:8px;vertical-align:top;border-right:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;font-weight:bold;text-align:right">
															<strong style="color:#4d8337">{{ format_number($booking->boo_money) }} <sup>đ</sup></strong>
														</td>
													</tr>
													<tr>
														<td style="padding:8px 0px 8px 8px;vertical-align:top;border-left:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;width:140px">
															<strong>Thanh toán</strong>
														</td>
														<td style="padding:8px;vertical-align:top;border-right:1px solid #e3e3e3;border-bottom:1px solid #e3e3e3;font-weight:bold;text-align:right">
															<strong style="color:#4d8337;font-size:16px">{{ format_number($booking->boo_money) }} <sup>đ</sup></strong>
														</td>
													</tr>
													<tr>
														<td colspan="2" style="padding:8px 8px 8px 0px;vertical-align:top;border:1px solid #e3e3e3;border-top:none;text-align:right">
															<i>(Giá chưa bao gồm Thuế và phí dịch vụ)</i>
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
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td style="background-color: #fff; padding: 0 25px;">
			<p style="margin:0px 0px 10px 0px; font-weight: bold; font-style: italic;">
				Lưu ý
			</p>
			<p style="margin:0px 0px 10px 0px">
				{{ SITE_NAME }} sẽ liên hệ với quý khách (qua email hoặc điện thoại) trong vòng 30 phút (T2-CN: 08:00 - 23:00) để xác nhận tour và thời hạn thanh toán.
			</p>
			<p style="margin:0px 0px 10px 0px">
				 Quý khách sẽ thanh toán (tại nhà, tại {{ SITE_NAME }}, chuyển khoản hay thẻ) sau khi có xác nhận còn tour từ {{ SITE_NAME }}.
			</p>
			<p style="margin:0px;">
				 Trường hợp Quý khách muốn xác nhận ngay, vui lòng liên hệ với {{ SITE_NAME }} theo Hotline:  <b>0927.253.666</b>
			</p>
		</td>
	</tr>
@stop