@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Quản lý modules ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Quản lý tours chưa duyệt
		<div class="pull-right">
			<a href="{{ route('tours.index') }}" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-list"></i> Tour đã duyệt</a>
		</div>
	</h3>
</div>
{{ $data_grid }}
@stop
@section('scripts')
	<script type="text/javascript" charset="utf-8">
		$(function() {
			// Select2
			$('.select2').select2();
		});
	</script>
@stop