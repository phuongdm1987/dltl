<div id="footer">
	<div id="footer-content">

		<div id="end-footer">
			<div id="content_endfooter">
				<div id="logo_footer" class="col-md-6" style="padding: 0;">
					<section class="fsd_top_one clearfix">
						<a class="logo" href="/" style="background: url(/assets/img/logo.png) center center; background-size: cover; display: block; overflow: hidden;"></a>
						<section class="fsd-contacts">
							<div class="fsd-text-heading">
								{{ $setting->owner }}
							</div>
							<div class="fsd-content-body">
								<p>Address:  {{ $setting->getAddress() }}</p>
								<p>Email: {{ $setting->getEmail() }}</p>
								<p class="tip">Website thử nghiệm đang chờ cấp phép</p>
							</div>
						</section>
					</section>

					<section class="subscribe clearfix">
						@if ($message = Session::get('error'))
							<p class="text-danger mg-bt-0 mg-t-5"><small>{{ $message }}</small></p>
						@elseif ($message = Session::get('success'))
							<p class="text-success mg-bt-0 mg-t-5"><small>{{ $message }}</small></p>
						@endif
						<form class="form-inline" method="POST" id="form-subscribe" action="{{ route('subscribe') }}#form-subscribe">
							<p class="note"> Đăng ký email để nhận khuyến mại lên đến <span class="discount">70%</span></p>
							<input type="email" class="form-control" id="subscriber" name="subscriber" placeholder="{{ $setting->getEmail() }}" required>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" id="btn-subscribe" class="btn btn-success btn-md">Subscribe</button>
							<!-- /input-group -->
						</form>
					</section>
				</div>
				<div class="fsd-box-new col-md-2">
					<div class="fsd-text-heading">
						Thông tin
					</div>
					<ul class="list-unstyled">
						<li>
							<a href="">Giới thiệu</a>
						</li>
						<li>
							<a href="">Điều khoản sử dụng</a>
						</li>
						<li>
							<a href=""> Liên hệ</a>
						</li>
						<li>
							<a href=""> Góp ý</a>
						</li>
						<li>
							<a href=""> Đối tác</a>
						</li>
					</ul>
				</div>
				<div class="left-end-footer col-md-2">
					<div style="width: 190px;">
						<div class="fb-like-box fb_iframe_widget" data-href="{{ $setting->getFacebook() }}" data-width="190" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
					</div>
				</div>

				{{-- <div class="left-end-footer col-md-2">
					<!-- Place this tag in your head or just before your close body tag. -->
					<script src="https://apis.google.com/js/platform.js" async defer>
					  {lang: 'vi'}
					</script>

					<!-- Place this tag where you want the widget to render. -->
					<div class="g-page" data-width="185" data-href="https://plus.google.com/102522123502603250345" data-showtagline="false" data-rel="publisher"></div>
				</div> --}}
			</div>
		</div>

		<div class="box_list_footer">
			<div class="title-footer">Tour theo các tỉnh thành</div>
			<div class="clear"></div>
			<div class="city_footer">
			<?php $citiesPart = array_chunk($GLB_Cities->toArray(), 6); ?>
			@foreach($citiesPart as $part)
				<ul>
					@foreach($part as $city)
						<li>
							<a title="{{ $city['cit_name'] }}" href="{{ route('tour.by.city', [$city['cit_id'], removeTitle($city['cit_name'])]) }}">
								@if(array_get($city, 'cit_hot') == 1)
									<strong>{{ $city['cit_name'] }}</strong>
								@else
									{{ $city['cit_name'] }}
								@endif
							</a>
						</li>
					@endforeach
				</ul>
			@endforeach
			</div>
		</div>
	</div>
</div>
<div id="loading"></div>
	<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.lazyload.min.js') }}"></script>
	<script src="{{ asset('assets/js/fancybox/source/jquery.fancybox.js') }}"></script>
	<script src="{{ asset('assets/js/spin.min.js') }}"></script>
	<script src="{{ asset('assets/js/tinymce4x/tinymce.min.js') }}"></script>
	<script src="{{ asset('assets/js/common.js') }}"></script>
	<script src="{{ asset('assets/js/functions.js') }}"></script>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '1601222106834169',
				xfbml      : true,
				version    : 'v2.3'
			});
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	{{-- Ga code --}}
	{{ $setting->getGACode() }}

	@yield('scripts')
</body>
</html>
