@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
	<div class="page-header">
	   <h3>
	      Quản lý subscribers
	   </h3>
	</div>
	{{ $data_grid }}
@stop