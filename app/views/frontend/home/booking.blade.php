@extends('frontend/layouts/tour')

@section('content')
	<div id="maincontent" class="container-fluid">
		<div id="wrapper_content">
			<div id="wrapper_booking">
				<form method="POST" name="form_booking" onsubmit="" action="">
					<div id="primary">
						<div class="col-md-4 col-booking">
							<div class="b_info_contact">
								<div class="panel_heading panel_heading_color1">
									<div class="icon_payment_title panel_heading_color1">
										1
									</div>
									<h3 class="title_book">Thông tin liên hệ</h3>
								</div>
								<div class="panel_body">
								  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
										<label class="control-label">
											Họ tên: <span class="text-danger">*</span>
										</label>
										{{ Form::text('name', $GLB_Login->check() ? $GLB_Login->getUser()->fullname : '', ['class' => 'form-control', 'id' => 'name']) }}
										{{ $errors->first('name', '<span class="help-inline text-danger">:message</span>') }}
									</div>
									<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
										<label class="control-label">
											Điện thoại: <span class="text-danger">*</span>
										</label>
										{{ Form::text('phone', $GLB_Login->check() ? $GLB_Login->getUser()->phone : '', ['class' => 'form-control', 'id' => 'phone']) }}
										{{ $errors->first('phone', '<span class="help-inline text-danger">:message</span>') }}
									</div>
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label class="control-label">
											Email: <span class="text-danger">*</span>
										</label>
										{{ Form::text('email', $GLB_Login->check() ? $GLB_Login->getUser()->email : '', ['class' => 'form-control', 'id' => 'email']) }}
										{{ $errors->first('email', '<span class="help-inline text-danger">:message</span>') }}
									</div>
									<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
										<label class="control-label">
											Địa chỉ: <span class="text-danger">*</span>
										</label>
										{{ Form::text('address', $GLB_Login->check() ? $GLB_Login->getUser()->address : '', ['class' => 'form-control', 'id' => 'address']) }}
										{{ $errors->first('address', '<span class="help-inline text-danger">:message</span>') }}
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-booking">
							<div class="b_info_booking">
								<div class="panel_heading panel_heading_color3">
									<div class="icon_payment_title panel_heading_color3">2</div>
									<h3 class="title_book">Thông tin đặt tour</h3>
								</div>
								<div class="panel_body">
									<div class="quick_hotel">
										<div class="img" style="height:initial;">
											<img src="{{ PATH_IMAGE_TOUR . $tourDetail->tou_image }}" alt="{{ $tourDetail->tou_name }}">
										</div>
										<div class="common infomation">
											<div>
												<div class="margin_negative_5">
													<h3>{{ $tourDetail->tou_name }}</h3>
												</div>
											</div>
											<table style="margin-bottom: 10px;">
												<tr>
													<td style="padding: 10px 0px 10px 10px;width:120px;">
														<b>Ngày khởi hành</b>
													</td>
													<td><input type="text" id="time_departure" name="time_departure" class="select_date date_start time_box datepicker" value=""></td>
												</tr>
												<tr>
													<td id="new_night" style="padding-left: 10px;"><b>Số phiếu :</b></td>
													<td><input id="count_tour" name="quantity" class="count_tour boundSearch" value="1" style="width: 33px;padding: 3px 3px 3px 10px;border-radius: 5px;" maxlength="3"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="clear"></div>
									<div class="booking_bill background_none">
										<h3>Thông tin thanh toán</h3>
										<div class="wap_bill">
											<table style="width: 100%;">
												<tbody><tr>
													<td class="w_60"><span id="stock">1</span> phiếu</td>
													<td class="w_10">x</td>
													<td class="w_80" style="color: #2e892e;">
													<span class="symbol_before"></span> <span data="{{ $tourDetail->getPriceRaw() }}" id="price_tour" class="price_show">{{ $tourDetail->getPrice() }} <sup>đ</sup></span></td>
													<td class="w_10"></td>
													<td class="w_50"></td>
													<td class="w_10">=</td>
													<td align="right" style="color: #2e892e;">
														<b id="money_total"><span class="symbol_before"></span> <span class="total_money_tour price_show">{{ $tourDetail->getPrice() }} <sup>đ</sup></span></b>
													</td>
												</tr>
											</tbody></table>
										</div>
										<p class="total_money">
											Tổng số tiền <b><span class="symbol_before"></span> <span class="total_money_tour price_show">{{ $tourDetail->getPrice() }} <sup>đ</sup></span></b>
										</p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-booking">
							<div id="method_mytour_pay_hotel" class="b_type_payment">
								<div class="panel_heading panel_heading_color2">
									<div class="icon_payment_title panel_heading_color2">3</div>
									<h3 class="title_book">Gửi yêu cầu đặt tour</h3>
								</div>
								<div class="panel_body">
									<div id="finish_pay" style="margin: 40px 0 20px;">
										<input class="fix_now_book no_pay_method" id="btn_booking_submit" type="submit" value="Hoàn thành" data-module="tour" data-version="0">
									</div>
									<div class=" boxnoti note_info_contact">
										<b class="title_note">Lưu ý:</b>
										<ul>
											<li>
												&bull; <b>VnGoing</b> sẽ liên hệ với quý khách (qua email hoặc điện thoại) trong vòng <b style="font-size: 15px; color: #e89928;">30 phút</b> (T2-CN: 08:00 - 23:00) để xác
												nhận tour và thời hạn thanh toán.
											</li>
											<li>
												&bull; Quý khách sẽ thanh toán (tại nhà, tại <b>VnGoing</b>, chuyển khoản hay thẻ) sau khi có xác nhận
												còn tour từ <b>VnGoing</b>.
											</li>
											<li class="last">
												&bull; Trường hợp Quý khách muốn xác nhận ngay, vui lòng liên hệ với <b>VnGoing</b> theo Hotline: <br/>
												<b>{{ $user->fullname }}: {{ $user->phone }}</b>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					 </div>
					 <input type="hidden" name="_token" value="{{ csrf_token() }}" />
				</form>
			</div>
		</div>
	</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(function(){
		changeMoneyTour();
	});
</script>
@stop