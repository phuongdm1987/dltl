@extends('frontend/layouts/admin/auth')

@section('styles')
   body {
      width: 100%;
      height: 100%;
      background: url(/assets/img/bg.jpg) 0 0 no-repeat;
      background-attachment: fixed;
   }
@stop

{{-- Page content --}}
@section('content')
<div id="sign-in">
	<h3><i class="glyphicon glyphicon-user"></i> Administration</h3>
	<form method="post" action="" class="form-horizontal" role="form">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- Email -->
		<div class="form-group{{ $errors->first('email', ' has-error') }}">
			<label class="control-label" for="email"><i class="glyphicon glyphicon-envelope"></i> Email</label>
			<div class="controls">
				<input type="text" class="form-control" autofocus name="email" id="email" value="{{ Input::old('email') }}" />
				{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Password -->
		<div class="form-group{{ $errors->first('password', ' has-error') }}">
			<label class="control-label" for="password"><i class="glyphicon glyphicon-wrench"></i> Password</label>
			<div class="controls">
				<input type="password" class="form-control" name="password" id="password" value="" />
				{{ $errors->first('password', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<!-- Form actions -->
		<div id="signin-footer">
			<div class="controls">
				<button type="submit" class="btn btn-danger btn-lg">LOGIN <i class="glyphicon glyphicon-circle-arrow-right"></i></button>
			</div>
		</div>
	</form>
</div>
@stop
