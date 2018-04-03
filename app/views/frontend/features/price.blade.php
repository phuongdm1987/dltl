@extends('frontend/layouts/default')

@section('content')
	<div id="heading-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1 class="heading-title">Bảng giá</h1>
				</div>
				<div class="col-md-5">
					<ul class="breadcrumb">
						<li><a href="/" class="link-title">Trang chủ</a></li>
						<li class="color-white">Bảng giá</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="bar background-white no-mb">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="heading text-center">
             		<h2>Bảng giá phần mềm</h2>
               </div>

               <div class="row waa-packages packages">
            		<div class="col-sm-4">
	            		<div class="package">
	            			<div class="package-header">
	                      	<h5>Tính năng</h5>
	                     </div>

	                     <div class="package-price">
	                     	Giá dịch vụ (VND/tháng/cửa hàng)
	                     </div>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">Hóa đơn</li>
	                     	<li class="waa-textRight"> Hóa đơn bán hàng</li>
	                     	<li class="waa-textRight">	Hóa đơn nhập hàng</li>
	                     	<li class="waa-textRight"> Hóa đơn chuyển hàng</li>
	                     	<li class="waa-textRight">	Hóa đơn trả hàng nhà cung cấp</li>
	                     	<li class="waa-textRight">	Hóa đơn trả hàng khách</li>
	                     </ul>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first"> Sản phẩm</li>
	                     	<li class="waa-textRight"> Tạo sản phẩm</li>
	                     	<li class="waa-textRight">	Import sản phẩm excel</li>
	                     	<li class="waa-textRight"> Export sản phẩm excel</li>
	                     	<li class="waa-textRight">	Tạo bộ sưu tập</li>
	                     	<li class="waa-textRight">	Quản lý sản phẩm</li>
	                     </ul>
	            		</div>
            		</div>

            		<div class="col-sm-2">
            			<div class="package">
	            			<div class="package-header light-gray">
	                      	<h5>Basic</h5>
	                     </div>
	                     <div class="package-price color-danger">
	                     	1.000.000 <sup>đ</sup>
	                     </div>
	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     </ul>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     </ul>
	                  </div>
            		</div>

            		<div class="col-sm-2">
            			<div class="package">
	            			<div class="package-header light-gray">
	                      	<h5>Pro</h5>
	                     </div>
	                     <div class="package-price color-danger">
	                     	1.000.000 <sup>đ</sup>
	                     </div>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     </ul>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     </ul>
	                  </div>
            		</div>

            		<div class="col-sm-2">
            			<div class="best-value">
	            				<div class="package">
		            			<div class="package-header">
		                      	<h5>Business</h5>
		                     </div>
		                     <div class="package-price color-danger">
		                     	1.000.000 <sup>đ</sup>
		                     </div>

		                     <ul class="package-features">
		                     	<li class="waa-package-header waa-first">&nbsp;</li>
		                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
		                     	<li class="waa-check"><i class="fa fa-check"></i></li>
		                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
		                     	<li class="waa-check"><i class="fa fa-check"></i></li>
		                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
		                     </ul>

		                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     </ul>
		                  </div>
            			</div>
            		</div>

            		<div class="col-sm-2">
            			<div class="package">
	            			<div class="package-header light-gray">
	                      	<h5>Ultimate</h5>
	                     </div>
	                     <div class="package-price color-danger">
	                     	1.000.000 <sup>đ</sup>
	                     </div>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     </ul>

	                     <ul class="package-features">
	                     	<li class="waa-package-header waa-first">&nbsp;</li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     	<li class="waa-check"><i class="fa fa-check"></i></li>
	                     	<li class="waa-uncheck"><i class="fa fa-times"></i></li>
	                     </ul>
	                  </div>
            		</div>
               </div>
				</div>
			</div>
		</div>
	</div>
@stop