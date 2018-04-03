@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
	<div class="page-header">
		<h3>
			Ý kiến khách hàng
			<div class="pull-right">
				<a href="{{ route('testimonial.edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
			</div>
		</h3>
	</div>
	{{ $data_grid }}
@stop