@extends('frontend/layouts/default')

@section('content')

	<div id="heading-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1 class="heading-title">Liên hệ</h1>
				</div>
				<div class="col-md-5">
					<ul class="breadcrumb">
						<li><a href="/" class="link-title">Trang chủ</a></li>
						<li class="color-white">Liên hệ với chúng tôi</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="content" class="page-main">
		<div class="container">
			<div class="row">
				@include('frontend/notifications')
			</div>
			<div class="row">
				<div class="col-md-8">
					<section>
						<div class="heading">
							<h3>Liên hệ với chúng tôi</h3>
						</div>
						{{ Form::open(['route' => 'contact.post', 'method' => 'POST']) }}
							<div class="form-group {{ $errors->has('fullname') ? 'error' : 'success' }}">
								<label for="firstname">Họ tên</label>
								{{ Form::text('fullname', Input::old('fullname'), ['class' => 'form-control']) }}
								{{ $errors->first('fullname', '<span class="help-inline">:message</span>') }}
							</div>

							<div class="form-group {{ $errors->has('email') ? 'error' : 'success' }}">
								<label for="email">Email</label>
								{{ Form::email('email', Input::old('email'), ['class' => 'form-control']) }}
								{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
							</div>

							<div class="form-group {{ $errors->has('message') ? 'error' : 'success' }}">
							  <label for="message">Nội dung</label>
							  {{ Form::textarea('message', Input::old('message'), ['class' => 'form-control']) }}
							  {{ $errors->first('message', '<span class="help-inline">:message</span>') }}
							</div>

							<div class="form-group text-center">
								<button type="submit" class="btn btn-template-main"><i class="fa fa-envelope-o"></i> Gửi nội dung</button>
							</div>
						{{ Form::close() }}
					</section>
				</div>

				<div class="col-md-4">
					<section>
						<h3 class="text-uppercase">Địa chỉ</h3>
						<address>
							{{ $setting->getAddress() }}
						</address>
						<h3 class="text-uppercase">Support</h3>
						<p class="text-muted">Mọi vấn đề thắc mắc hãy liên hệ với chúng tôi.</p>
						<ul class="list-unstyled">
							<li><strong><a href="mailto: {{ $setting->getEmail() }}"><i class="fa fa-envelope-o"></i> {{ $setting->getEmail() }}</a></strong></li>
							<li><strong><a href="javascript:;"><i class="fa fa-phone"></i> {{ $setting->getPhone() }}</a></strong></li>
						</ul>
					</section>
				</div>
			</div>
		</div>
	</div>
@stop