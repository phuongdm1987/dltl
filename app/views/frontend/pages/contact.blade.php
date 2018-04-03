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
				<div class="col-md-8">
					<section>
						<div class="heading">
							<h3>Liên hệ với chúng tôi</h3>
						</div>
						{{ Form::open() }}
							<div class="form-group">
								<label for="firstname">Họ tên</label>
								{{ Form::text('fullname', null, ['class' => 'form-control']) }}
							</div>

							<div class="form-group">
								<label for="email">Email</label>
								{{ Form::email('email', null, ['class' => 'form-control']) }}
							</div>

							<div class="form-group">
	                    <label for="message">Nội dung</label>
	                    <textarea id="message" class="form-control"></textarea>
                   	</div>
                   	<div class="form-group text-center">
                   		<button type="submit" class="btn btn-template-main"><i class="fa fa-envelope-o"></i> Gửi nội dung</button>
                   	</div>
						{{ Form::close() }}
					</section>
				</div>
			</div>
		</div>
	</div>

@stop