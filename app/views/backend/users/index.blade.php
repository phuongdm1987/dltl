@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Quản lý tài khoản quản trị ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Quản lý tài khoản quản trị
		<div class="pull-right">
			<a href="{{ route('create/user') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
		</div>
	</h3>
</div>

<form action="" method="GET" class="well">
	<table>
		<tr>
			<td>
				<table>
					<tr>
						<td><input class="form-control btn-flat" type="text" value="{{ Input::get('id') }}" name="id" placeholder="ID"></td>
						<td><input class="form-control btn-flat" type="text" value="{{ Input::get('fullname') }}" name="fullname" placeholder="Fullname"></td>
						<td><input class="form-control btn-flat" type="text" value="{{ Input::get('email') }}" name="email" placeholder="Email"></td>
					</tr>
				</table>
			</td>
			<td>
				<input type="submit" value="Tìm kiếm" class="btn btn-primary btn-flat btn-sm">
			</td>
		</tr>
	</table>
</form>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="10">#</th>
			<th>Fullname</th>
			<th>@lang('admin/users/table.email')</th>
			<th>@lang('admin/users/table.created_at')</th>
			<th>Fake login</th>
			<th width="30">Atv</th>
			<th width="30">Edit</th>
         <th width="30">Del</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $index => $user)
		<?php //_debug($user);die; ?>
		<tr>
			<td>{{ ++$index }}</td>
			<td>{{ $user->fullName() }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ date('H:i - d/m/Y', strtotime($user->created_at)) }}</td>
			<td><a target="_blank" href="{{ route('admin/user/fake-login', array($user->id)) }}" class="btn btn-xs btn-primary"><i class="fa fa-sign-in"></i> Login</a></td>
			<td class="text-center"><a class="btn-action btn-active-action" href="{{ route('active/user', $user->id) }}"><i class="fa {{ $user->isActivated() ? 'fa-check-square' : 'fa-square-o' }}"></i></a></td>
			<td class="text-center"><a class="btn-action btn-edit-action" href="{{ route('update/user', $user->id) }}"><i class="fa fa-edit"></i></a></td>
			<td class="text-center">
				@if (! is_null($user->deleted_at))
				<a class="btn-action btn-restore-action" href="{{ route('restore/user', $user->id) }}"><i class="fa fa-retweet text-success"></i></a>
				@else
				@if ($GLB_Login->getId() !== $user->id && $user->id != 1)
					<a class="btn-action btn-delete-action" href="{{ route('delete/user', $user->id) }}"><i class="fa fa-trash-o text-danger"></i></a>
				@endif
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $users->links() }}
@stop
