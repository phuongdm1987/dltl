<section id="login">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3">
				<div class="form-wrap">
					<h1 class="mg-5">Quên mật khẩu</h1>
					{{ Form::open(['role' => 'form', 'method' => 'POST', 'id' => 'login-form', 'autocomplete' => 'off']) }}
						<div class="form-group {{ hasValidator('email') }}">
							<label for="email" class="text-normal col-lg-3 col-md-3">Email</label>
							<div class="col-lg-9 col-md-9 col-sm-12">
								{{ Form::email('email', null, ['id' => 'email', 'autofocus' => 'autofocus', 'class' => 'form-control btn-flat', 'placeholder' => 'example@gmail.com']) }}
								{{ alertError('email') }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-9 col-md-9 col-sm-12 col-lg-offset-3 col-sm-offset-0">
								<button type="submit" id="btn-forgot" class="btn btn-custom btn-md btn-block btn-flat pull-left">Gửi</button>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div> <!-- /.col-xs-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section>