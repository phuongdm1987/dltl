@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Quản lý banner ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      Quản lý banner
      <div class="pull-right">
         <a href="{{ route('edit-banner', array(0)) }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
      </div>
   </h3>
</div>
{{ $data_grid }}
@stop
