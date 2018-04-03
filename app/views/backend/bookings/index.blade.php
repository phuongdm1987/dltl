@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Quản lý  booking ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Quản lý  booking
	</h3>
</div>
<div id="grid-container">
	<form method="GET" action="" class="grid-form-search" style="overflow: hidden;">
		<div class="col-sm-3  pd-l-0">
			<input class="form-control btn-flat" name="q" value="{{ Input::get('q') }}" placeholder="Nhập mã tour" type="text">
		</div>

		<div class="col-sm-3  pd-l-0">
			<select name="status" class="form-control btn-flat">
				@foreach($listStatus as $key => $value)
					<option value="{{ $key }}" {{ Input::get('status') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-sm-2  pd-l-0">
			<button type="submit" class="btn btn-primary btn-md btn-flat btn-flat"> Tìm kiếm</button>
		</div>
	</form>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th width="10">#</th>
				<th width="250"> Thông tin khách hàng</th>
				<th width="250"> Thông tin tour</th>
				<th width="250"> Thông tin thanh toán</th>
				<th width="200"> Thông tin chủ tour</th>
				<th width="120"> Trạng thái</th>
			</tr>
		</thead>
		<tbody>
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
								<td>Mã đơn: </td>
								<td style="color: #5766FD; font-weight: bold">{{ $booking->boo_code }}</td>
							</tr>
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
						</table>
					</td>
					<td>
						<table class="table-condensed table-sub table">
							<tr>
								<td> Họ tên</td>
								<td> {{ $booking->fullname }}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>{{ $booking->email }}</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td>{{ $booking->phone }}</td>
							</tr>
						</table>
					</td>
					<td class="text-center">
						<label class="btn btn-xs btn-flat {{ $booking->getCssBtnStatus() }}">{{ $booking->getTextStatus()  }}</label>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $bookings->appends(Input::all())->links() }}
</div>
@stop
{{-- @section('scripts')
	<script type="text/javascript">
		$(function() {
			$('.js-change-status').click(function(e) {
				e.preventDefault();
				var $this = $(this);
				$.ajax({
					url : '/admin/bookings/' + $this.data('id') + '/change-status',
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
@stop --}}