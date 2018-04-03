@extends('backend/layouts/iframe')

{{-- Web site Title --}}
@section('title')
Quản lý nhóm quản trị ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Nhóm quản trị
		<div class="pull-right">
			<a href="{{ route('create/group') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
		</div>
	</h3>
</div>

{{ $groups->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="10">#</th>
			<th>@lang('admin/groups/table.name')</th>
			<th>@lang('admin/groups/table.users')</th>
			<th>@lang('admin/groups/table.created_at')</th>
			<th width="30">Edit</th>
         <th width="30">Del</th>
		</tr>
	</thead>
	<tbody>
		@if ($groups->count() >= 1)
		@foreach ($groups as $index => $group)
		<tr>
			<td>{{ ++$index }}</td>
			<td>{{ $group->name }}</td>
			<td>{{ $group->users()->count() }}</td>
			<td>{{ date('H:i - d/m/Y', strtotime($group->created_at)) }}</td>
			<td class="text-center"><a class="btn-action btn-edit-action" href="{{ route('update/group', $group->id) }}"><i class="fa fa-edit"></i></a></td>
			<td class="text-center"><a class="btn-action btn-delete-action" href="{{ route('delete/group', $group->id) }}"><i class="fa fa-trash-o text-danger"></i></a></td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">Không có dữ liệu</td>
		</tr>
		@endif
	</tbody>
</table>

{{ $groups->links() }}
@stop
