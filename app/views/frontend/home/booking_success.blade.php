@extends('dltl/layouts/master')

@section('content')
	<div class="container" id="booking-success">
		<div class="notification">
			<div class="alert alert-success fsd-flat alert-dismissible fade in" role="alert">
				Chúc mừng bạn đã đặt tour thành công. Cảm ơn quý khách đã sử dụng dịch vụ của <strong>{{ SITE_NAME }}</strong>
			</div>
		</div>

		<div class="tour-code">
			Mã tour: <span>{{ $booking->boo_code }}</span>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<table class="table table-hover">
					<caption>Thông tin khách hàng</caption>
					<tr>
						<td>Họ tên</td>
						<td>{{ $booking->boo_customer_name }}</td>
					</tr>
					<tr>
						<td>Số điện thoại</td>
						<td>{{ $booking->boo_customer_phone }}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>{{ $booking->boo_customer_email }}</td>
					</tr>
					<tr>
						<td>Địa chỉ</td>
						<td>{{ $booking->boo_customer_address }}</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-6">
				<table class="table table-hover">
					<caption>Thông tin tour</caption>
					<tr>
						<td>Ngày tạo</td>
						<td>{{ $booking->getCreatedAt() }}</td>
					</tr>
					<tr>
						<td>Ngày khởi hành</td>
						<td>{{ $booking->getDepartureAt() }}</td>
					</tr>
					<tr>
						<td>Điểm khởi hành</td>
						<td>{{ $tour->city->cit_name }}</td>
					</tr>
					<tr>
						<td>Điểm đến</td>
						<td>{{ $tour->tou_place_destination }}</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-12">
				<table class="table table-hover">
					<caption>Thông tin thanh toán</caption>
					<tr>
						<td>Tour du lịch</td>
						<td>{{ $tour->tou_name }}</td>
					</tr>
					<tr>
						<td>Giá tour</td>
						<td><strong class="text-danger">{{ format_number($booking->boo_tour_price) }} <sup>đ</sup></strong></td>
					</tr>
					<tr>
						<td>Số phiếu đặt</td>
						<td><strong>{{ $booking->boo_quantity }}</strong></td>
					</tr>
					<tr>
						<td>Tổng tiền</td>
						<td><strong class="text-danger">{{ format_number($booking->boo_money) }} <sup>đ</sup></strong></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@stop