@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Quản lý danh mục ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Quản lý danh mục
		<div class="pull-right">
			<a href="{{ route('create/categories') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
		</div>
	</h3>
</div>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="10">#</th>
			<th>Name</th>
			<th width="30">Atv</th>
			<th width="30">Edit</th>
			<th width="30">Del</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$row_count = 0;
		?>
		@foreach ($categories as $category)
			<tr>
				<td>{{ ++$row_count }}</td>
				<td>
					@for ($i = 0; $i < $category->level; $i++)
						{{ '&rarr;' }}
					@endfor
					{{ $category->parents == 0 ? '<strong>' . $category->name . '</strong>' : $category->name }}
				</td>
				<td class="text-center"><a class="btn-action btn-active-action" href="{{ route('active/categories', $category->id) }}"><i class="fa {{ $category->active > 0 ? 'fa-check-square' : 'fa-square-o' }}"></i></a></td>
				<td class="text-center"><a class="btn-action btn-edit-action" href="{{ route('edit/categories', $category->id) }}"><i class="fa fa-edit"></i></a></td>
				<td class="text-center"><a class="btn-action btn-delete-action" href="{{ route('delete/categories', $category->id) }}"><i class="fa fa-trash-o text-danger"></i></a></td>
			</tr>
		@endforeach
	</tbody>
</table>
@stop
