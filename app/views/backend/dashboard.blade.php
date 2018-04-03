@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Blog Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
   <div class="page-header">
      <h3>Bảng điều khiển <span>Thống kê và những thông tin khác</span></h3>
   </div>
   <p class="db-time clearfix"><span class="text-error">{{ $daysOfWeek[date('w')] . ", ngày " . date('d/m/Y') }}</span></p>
@stop