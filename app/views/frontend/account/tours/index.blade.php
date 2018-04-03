@extends('dltl/layouts/account')

@section('content')
<div class="header">
   <h3>Danh sách tour</h3>
   <div class="clearfix border-header">
      <hr class="hight-line">
      <hr class="">
   </div>
</div>
<section class="main-body">
	<div role="tabpanel">
		<div class="fsd-filter clearfix">
			<form class="form-horizontal row" method="GET">
				<div class="col-sm-6 pd-l-0">
					<input type="text" name="query" value="{{ Input::get('query') }}" class="form-control btn-flat" placeholder="Tìm kiếm theo tên tour">
				</div>
				<div class="col-sm-4 pd-l-0">
					<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tìm kiếm</button>
					<a href="{{ route('account.tour.index') }}" class="btn btn-default btn-flat"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
				</div>
			</form>
		</div>
		<p class="clearfix" style="margin: 20px 0px 10px;">Tổng số tour: {{ $tours->getTotal() }}</p>
		<table class="table table-hover table-bordered">
			<thead>
				<th width="30">STT</th>
				<th width="150">Tên tour</th>
				<th class="text-center" width="120">Ảnh tour</th>
				<th>Thông tin tour</th>
				<th class="text-center" width="100">Trạng thái</th>
				<th class="text-center" width="80">Thao tác</th>
			</thead>

			<tbody>
			@if(! $tours->isEmpty())
				@foreach($tours as  $key => $tour)
					<tr>
						<td class="text-center">{{ $key + 1 }}</td>
						<td>{{ $tour->tou_name }}</td>
						<td>
							<div class="tour-image" style="background: url('{{ $tour->getImage() }}') center center; background-size: cover; width: 100px; height: 100px;"></div>
						</td>
						<td>
							<table class="table-condensed table-sub table">
								<tr>
									<td>Giá: </td>
									<td>{{ format_number($tour->tou_price) }} <sup>đ</sup></td>
								</tr>
								<tr>
									<td>Thời gian</td>
									<td>{{ $tour->tou_day }} ngày - {{ $tour->tou_night }} đêm</td>
								</tr>
								<tr>
									<td width="100">Điểm đến</td>
									<td>{{ $tour->getPlace() }}</td>
								</tr>
								<tr>
									<td width="100">Phương tiện</td>
									<td>{{ $tour->tou_vehicle }}</td>
								</tr>
								<tr>
									<td colspan="2" class="text-center">
										<a href="{{ route('account.tour.photo', [$tour->tou_id, removeTitle($tour->tou_name)]) }}" class="btn btn-info btn-xs"><i class="fa fa-picture-o"></i> Ảnh chi tiết</a>
									</td>
								</tr>
							</table>
						</td>
						<td>
							{{ $tour->getTextStatus() }}
						</td>
						<td class="text-center">
							<a href="{{ route('account.tour.edit', [$tour->tou_id]) }}" title="{{ $tour->tou_name }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i></a>
							<a href="{{ route('account.tour.delete', [$tour->tou_id]) }}" title="{{ $tour->tou_name }}" class="btn btn-xs btn-danger js_remover"><i class="fa fa-trash-o"></i></a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6">Chưa có tour nào được đăng</td>
				</tr>
			@endif
			</tbody>
		</table>
		{{ $tours->appends(Input::all())->links() }}
	</div>
</section>
@stop