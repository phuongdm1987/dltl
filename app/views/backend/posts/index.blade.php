@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
	<div class="page-header">
	   <h3>
	      Quản lý bài viết
	      <div class="pull-right">
	         <a href="{{ route('post.edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
	      </div>
	   </h3>
	</div>
	{{ $data_grid }}
@stop