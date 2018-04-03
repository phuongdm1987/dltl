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
      Quản lý quốc gia
      <div class="pull-right">
         <a href="{{ route('country.edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
      </div>
   </h3>
</div>

	{{ $data_grid }}

@stop
