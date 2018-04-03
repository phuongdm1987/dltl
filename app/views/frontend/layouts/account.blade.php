@include ('frontend/includes/header')

<!-- Content ***===============================================-->
	<section id="content" class="fsd-page-content page-account">
		<section class="row">
			<div class="col-sm-12">
				@include('frontend/notifications')
			</div>
		</section>
		<section class="left-side col-md-3 col-sm-3 hidden-xs" style="padding-left: 0;">
			<div class="fsd-box left-box">
				<h4 class="text-center fsd-box-manager">Danh mục quản lý</h4>
				<ul class="nav nav-sidebar fsd-nav-menu">
				<li class="{{ Request::segment(3) == 'create' ? 'active' : '' }}">
						<a href="{{ route('account.tour.edit') }}">Tạo mới tour</a>
					</li>
					<li class="{{ Request::url() == route('account.tour.index') ? 'active' : '' }}">
						<a href="{{ route('account.tour.index') }}">Danh sách tour</a>
					</li>
					<li class="{{ Request::url() == route('account.booking.index') ? 'active' : '' }}">
						<a href="{{ route('account.booking.index') }}">Danh sách bookings khách</a>
					</li>
					<li class="{{ Request::url() == route('account.booking.me') ? 'active' : '' }}">
						<a href="{{ route('account.booking.me') }}">Danh sách bookings</a>
					</li>
					<li class="{{ Request::segment(2) == 'profile' ? 'active' : '' }}"><a href="{{ route('profile.index') }}">Thông tin cá nhân</a></li>
				</ul>
			</div>
		</section>

		<section class="main-side col-sm-9" style="padding: 0;">
			@yield('content')
		</section>
	</section>
<!-- *** FOOTER ***=============================================-->
@include ('frontend/includes/footer')