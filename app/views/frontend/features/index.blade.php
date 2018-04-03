@extends('frontend/layouts/default')

@section('content')
	<div id="heading-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1 class="heading-title">Tính năng</h1>
				</div>
				<div class="col-md-5">
					<ul class="breadcrumb">
						<li><a href="/" class="link-title">Trang chủ</a></li>
						<li class="color-white">Danh sách tính năng</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section class="bar background-gray no-mb padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý sản phẩm</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-sitemap"></i> Quản lý theo danh mục, nhóm hàng</li>
						<li><i class="fa fa-search-plus"></i>  Tìm kiếm sản phẩm thông minh</li>
						<li><i class="fa fa-pencil-square-o"></i>  Cập nhật thông tin sản phẩm linh hoạt</li>
						<li><i class="fa fa-eye"></i> Xem thông tin chi tiết sản phẩm hàng hóa</li>
						<li><i class="fa fa-file-excel-o"></i> Nhập liệu sản phẩm bằng Excel</li>
						<li><i class="fa fa-archive"></i> Đồng bộ với website bán hàng online</li>
						<li><i class="fa fa-history"></i> Lịch sử nhập, bán sản phẩm</li>
					</ul>
				</div>
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-customize.png') }}" alt="" class="img-responsive">
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý bán hàng-->
	<section class="bar no-mb color-white padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-code.png') }}" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý bán hàng</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-cart-plus"></i> Bán hàng dễ dàng & thuận tiện</li>
						<li><i class="fa fa-refresh"></i> Đồng bộ với website bán hàng Online</li>
						<li><i class="fa fa-cog"></i> Tùy chỉnh chiết khấu giá bán sản phẩm</li>
						<li><i class="fa fa-code-fork"></i> Quản lý đổi trả hàng của khách hàng </li>
						<li><i class="fa fa-print"></i> In phiếu bán hàng</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý kho hàng-->
	<section class="bar background-gray no-mb padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý kho hàng</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-plus-circle"></i> Tạo phiếu nhập kho, xuất kho</li>
						<li><i class="fa fa-cloud-download"></i> Quản lý xuất nhập tồn theo cửa hàng</li>
						<li><i class="fa fa-code-fork"></i> Quản lý luân chuyển kho nội bộ</li>
						<li><i class="fa fa-sun-o"></i> Quản lý báo cáo hạn mức tồn kho</li>
						<li><i class="fa fa-refresh"></i> Tự động bù trừ kho</li>
						<li><i class="fa fa-history"></i> Quản lý lịch sử hàng hóa trong kho</li>
					</ul>
				</div>
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-customize.png') }}" alt="" class="img-responsive">
				</div>
			</div>
		</div>
	</section>

	<!-- Nhà cung cấp-->
	<section class="bar no-mb color-white padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-code.png') }}" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý nhà cung cấp</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-plus-circle"></i> Quản lý thông tin nhà cung cấp</li>
						<li><i class="fa fa-cloud-download"></i> Tìm kiếm theo mã, tên nhà cung cấp</li>
						<li><i class="fa fa-code-fork"></i> Theo dõi lịch sử nhập hàng</li>
						<li><i class="fa fa-sun-o"></i> Quản lý nhập hàng theo từng nhà cung cấp</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý nhân viên-->
	<section class="bar background-gray no-mb padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý nhân viên, phân quyền</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-list-alt"></i> Quản lý danh sách nhân viên</li>
						<li><i class="fa fa-eye-slash"></i> Xem thông tin chi tiết nhân viên </li>
						<li><i class="fa fa-code-fork"></i> Theo dõi báo cáo doanh số từng nhân viên</li>
						<li><i class="fa fa-area-chart"></i> Thống kê đơn hàng bán ra từng ngày</li>
						<li><i class="fa fa-heart-o"></i> Thiết lập quyền cho từng nhân viên</li>
						<li><i class="fa fa-heart-o"></i> Cập nhật thông tin</li>
					</ul>
				</div>
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-customize.png') }}" alt="" class="img-responsive">
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý công nợ -->
	<section class="bar no-mb color-white padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-code.png') }}" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý công nợ</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-money"></i> Theo dõi công nợ nhà cung cấp</li>
						<li><i class="fa fa-money"></i> Theo dõi công nợ khách hàng</li>
						<li><i class="fa fa-file-excel-o"></i> Xuất export công nợ</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý thu chi-->
	<section class="bar background-gray no-mb padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý thu chi</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-eye-slash"></i> Tạo phiếu thu/chi</li>
						<li><i class="fa fa-heart-o"></i> Xem thông tin phiếu thu chi</li>
						<li><i class="fa fa-file-excel-o"></i> Xuất phiếu thu chi</li>
						<li><i class="fa fa-print"></i> In phiếu thu chi</li>
					</ul>
				</div>
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-customize.png') }}" alt="" class="img-responsive">
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý chi nhánh -->
	<section class="bar no-mb color-white padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-code.png') }}" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý chi nhánh</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-money"></i> Xem thông tin chi nhánh</li>
						<li><i class="fa fa-money"></i> Thêm, cập nhật, xóa chi nhánh</li>
						<li><i class="fa fa-file-excel-o"></i> Luân chuyển chi nhánh chính</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Quản lý thống kê-->
	<section class="bar background-gray no-mb padding-big text-center-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-uppercase">Quản lý thống kê</h2>
					<ul class="list-style-none list-features">
						<li><i class="fa fa-area-chart"></i> Thống kê lợi nhuận, doanh thu</li>
						<li><i class="fa fa-bar-chart"></i> Thống kê doanh số bán hàng nhân viên</li>
						<li><i class="fa fa-calendar-o"></i> Xem thống kê theo tuần, tháng, năm</li>
					</ul>
				</div>
				<div class="col-md-6 text-center">
					<img src="{{ asset('assets/img/template-easy-customize.png') }}" alt="" class="img-responsive">
				</div>
			</div>
		</div>
	</section>

	{{-- <!-- /.bar -->
   <section class="bar background-gray no-mb">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="heading text-center">
                  <h2>Liên kết</h2>
               </div>
               <ul class="owl-carousel customers">
                  <li class="item">
                     <img src="{{ asset('assets/img/customer-1.png') }}" alt="" class="img-responsive">
                  </li>
                  <li class="item">
                     <img src="{{ asset('assets/img/customer-2.png') }}" alt="" class="img-responsive">
                  </li>
                  <li class="item">
                     <img src="{{ asset('assets/img/customer-3.png') }}" alt="" class="img-responsive">
                  </li>
                  <li class="item">
                     <img src="{{ asset('assets/img/customer-4.png') }}" alt="" class="img-responsive">
                  </li>
                  <li class="item">
                     <img src="{{ asset('assets/img/customer-5.png') }}" alt="" class="img-responsive">
                  </li>
                  <li class="item">
                     <img src="{{ asset('assets/img/customer-6.png') }}" alt="" class="img-responsive">
                  </li>
               </ul>
               <!-- /.owl-carousel -->
            </div>
         </div>
      </div>
   </section> --}}
@stop