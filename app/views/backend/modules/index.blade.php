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
      Quản lý modules
      <div class="pull-right">
         <a href="{{ route('create/modules') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
      </div>
   </h3>
</div>

<table class="table table-bordered table-striped table-hover">
   <thead>
      <tr>
         <th width="10">#</th>
         <th>Name</th>
         <th>Link</th>
         <th>Order</th>
         <th>Created at</th>
         <th width="30">Atv</th>
         <th width="30">Edit</th>
         <th width="30">Del</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($modules as $module)
         <tr>
            <td>{{ $module->id }}</td>
            <td>{{ $module->name }}</td>
            <td>{{ $module->link }}</td>
            <td>{{ $module->order }}</td>
            <td>{{ date('d/m/Y', $module->time_create) }}</td>
            <td class="text-center"><a class="btn-action btn-active-action" href="{{ route('active/modules', $module->id) }}"><i class="fa {{ $module->active > 0 ? 'fa-check-square' : 'fa-square-o' }}"></i></a></td>
            <td class="text-center"><a class="btn-action btn-edit-action" href="{{ route('edit/modules', $module->id) }}"><i class="fa fa-edit"></i></a></td>
            <td class="text-center"><a class="btn-action btn-delete-action" href="{{ route('delete/modules', $module->id) }}"><i class="fa fa-trash-o text-danger"></i></a></td>
         </tr>
      @endforeach
   </tbody>
</table>
@stop
