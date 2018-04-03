@extends('dltl/layouts/account')

@section('content')
<div class="header">
   <h3>Danh sách booking khách hàng</h3>
   <div class="clearfix border-header">
      <hr class="hight-line">
      <hr class="">
   </div>
</div>
<section class="main-body">
	<div role="tabpanel">
		<p>Tổng số booking: {{ $bookings->getTotal() }}</p>
		<table class="table table-hover table-bordered">
			<thead>
				<th width="30">Stt</th>
				<th class="text-center" width="250">Thông tin khách hàng</th>
				<th class="text-center" width="400">Thông tin đặt tour</th>
				<th class="text-center" width="250">Thông tin thanh toán</th>
				<th class="text-center" width="250">Trạng thái/Thao tác</th>
			</thead>
			@if (! $bookings->isEmpty())
				@foreach($bookings as $key => $booking)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>
							<table class="table-condensed table-sub table">
								<tr>
									<td>Họ tên: </td>
									<td>{{ $booking->getCustomerName() }}</td>
								</tr>
								<tr>
									<td>Số điện thoại: </td>
									<td>{{ $booking->getCustomerPhone() }}</td>
								</tr>
								<tr>
									<td>Email: </td>
									<td>{{ $booking->getCustomerEmail() }}</td>
								</tr>
								<tr>
									<td>Địa chỉ: </td>
									<td>{{ $booking->getCustomerAddress() }}</td>
								</tr>
							</table>
						</td>
						<td>
							<table class="table-condensed table-sub table">
								<tr>
									<td>Tên tour: </td>
									<td>{{ $booking->tou_name }}</td>
								</tr>
								<tr>
									<td>Điểm đến</td>
									<td>{{ $booking->tou_place_destination }}</td>
								</tr>
								<tr>
									<td>Ngày khởi hành: </td>
									<td>{{ date('d/m/Y', $booking->boo_time_departure) }}</td>
								</tr>
							</table>
						</td>
						<td>
							<table class="table-condensed table-sub table">
								<tr>
									<td>Số phiếu: </td>
									<td>{{ $booking->boo_quantity }}</td>
								</tr>
								<tr>
									<td>Đơn giá: </td>
									<td style="color: red; font-weight: bold">{{ format_number($booking->boo_tour_price) }}đ</td>
								</tr>
								<tr>
									<td>Tổng số tiền: </td>
									<td style="color: red; font-weight: bold">{{ format_number($booking->boo_money) }}đ</td>
								</tr>
								<tr>
									<td>Mã đơn: </td>
									<td style="color: #5766FD; font-weight: bold">{{ $booking->boo_code }}</td>
								</tr>
							</table>
						</td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-xs btn-flat {{ $booking->getCssBtnStatus() }}">{{ $booking->getTextStatus() }}</button>
								<button type="button" class="btn btn-xs btn-flat {{ $booking->getCssBtnStatus() }} dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
								<?php
									$listStatus = Fsd\Bookings\Booking::getListStatus();
								?>
									@foreach($listStatus as $key => $value)
										<li><a class="js-change-status" data-id="{{ $booking->getId() }}" data-status="{{ $key }}" href="#">{{ $value }}</a></li>
									@endforeach
								</ul>
							</div>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4"> Hiện tại bạn chưa đặt tour nào!</td>
				</tr>
			@endif
		</table>
		{{ $bookings->appends(Input::all())->links() }}
	</div>
</section>
@stop

@section('script')
	<script type="text/javascript">
		$(function() {
			$('.js-change-status').click(function(e) {
				e.preventDefault();
				var $this = $(this);
				$.ajax({
					url : '/account/booking/' + $this.data('id') + '/change-status',
					type : "GET",
					data : {
						status : $this.data('status')
					},
					dataType : "json",
					beforeSend : initSpin,
					success : function(response) {
						stopSpin();
						if(response.code == 1) {
							window.location.reload();
						}
					}
				});
			});
		});
	</script>
@stop