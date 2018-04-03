@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
	<div class="page-header">
	   <h3>
	      Quản lý pages
	      <div class="pull-right">
	         <a href="{{ route('page.edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
	      </div>
	   </h3>
	</div>
	{{ $data_grid }}
@stop