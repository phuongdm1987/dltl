@extends('frontend/layouts/default')

@section('content')
	<div id="content" class="page-main">
		<div class="container">
			<div class="row">
				<div class="col-md-3 scrollspy">
					<ul id="nav" class="nav hidden-xs hidden-sm affix">
						<li class="active">
							<a href="#hot"><i class="fa fa-star-o"></i> Tính năng nổi bật</a>
						</li>
						<li>
							<a href="#statistic"><i class="fa fa-pie-chart"></i> Quản lý thống kê</a>
						</li>
						<li>
							<a href="#orders"><i class="fa fa-cart-plus"></i> Quản lý bán hàng</a>
						</li>
						<li>
							<a href="#products"><i class="fa fa-cubes"></i> Quản lý sản phẩm</a>
						</li>
						<li>
							<a href="#stores"><i class="fa fa-database"></i> Quản lý kho</a>
						</li>
						<li>
							<a href="#staffs"><i class="fa fa-users"></i> Quản lý nhân viên</a>
						</li>
						<li>
							<a href="#branch"><i class="fa fa-code-fork"></i> Quản lý chi nhánh, nhà cung cấp</a>
						</li>
						<li>
							<a href="#report"><i class="fa fa-krw"></i> Quản lý báo cáo</a>
						</li>
						<li>
							<a href="#debts"><i class="fa fa-money"></i> Quản lý công nợ, sổ quỹ</a>
						</li>
						<li>
							<a href="#history"><i class="fa fa-history"></i> Quản lý lịch sử hoạt động</a>
						</li>
					</ul>
				</div>

				<div class="col-md-9">
					<section id="hot" class="waa-docs-section">
						<h2><i class="fa fa-star-o"></i> Tính năng nổi bật</h2>
						<div class="waa-box-content">
							<section class="waa-photo">
								<img class="img-responsive" alt="Tính năng nổi bật" src="{{ asset('assets/img/waa/hot.jpg') }}">
							</section>
							<!-- Thống kê-->
							<section class=" background-white no-mb padding-big text-center-sm">
								<div class="row">
									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/dashboard.jpg') }}">
									</div>
									<div class="col-md-6">
										<h2 class="text-uppercase waa-heading-title">Quản lý thống kê</h2>
										<p class="mb-small">
											Phần mền quản lý bán hàng Waa đã tích hợp biểu đồ thống kê doanh thu, lợi nhuận, doanh số bán hàng của nhân viên một cách trực quan.
											Giúp cho người quản lý có thể xem một cách rõ ràng, và dễ hiểu hơn.
										</p>
									</div>
								</div>
							</section>

							<!--Bán hàng-->
							<section class=" no-mb  padding-big text-center-sm">
								<div class="row">
									<div class="col-md-5 col-md-offset-1">
										<h2 class="text-uppercase waa-heading-title">Quản lý bán hàng</h2>
										<p class="mb-small">
											Quản lý bán hàng giải quyết những khó khăn trong hoạt động kinh doanh bán lẻ giúp bạn bán hàng một cách nhanh chóng và dễ dàng hơn.
										</p>
									</div>

									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlphieubanhang.jpg') }}">
									</div>
								</div>
							</section>

							<section class=" background-white no-mb padding-big text-center-sm">
								<div class="row">
									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlsanpham.jpg') }}">
									</div>
									<div class="col-md-6">
										<h2 class="text-uppercase waa-heading-title">Quản lý sản phẩm</h2>
										<p class="mb-small">
											Quản lý sản phẩm theo nhóm hàng hóa, ngành hàng mà bạn lựa chọn kinh doanh. Cập nhật đầy đủ thông tin , dễ dàng tùy biến dễ dàng nhanh gọn.
										</p>
									</div>
								</div>
							</section>

							<section class=" no-mb  padding-big text-center-sm">
								<div class="row">
									<div class="col-md-5 col-md-offset-1">
										<h2 class="text-uppercase waa-heading-title">Quản lý kho linh hoạt</h2>
										<ul class="list-style-none list-features">
											<li>Thống kê hàng tồn kho giúp lên kế hoạch bổ sung hàng hóa kịp thời</li>
											<li>Tự động cân bằng giữ các kho mỗi khi có phát sinh đơn hàng</li>
										</ul>
									</div>

									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlbaocaokho.jpg') }}">
									</div>
								</div>
							</section>

							<section class=" background-white no-mb padding-big text-center-sm">
								<div class="row">
									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlphieunhaphang.jpg') }}">
									</div>
									<div class="col-md-6">
										<h2 class="text-uppercase waa-heading-title">Quản lý đơn hàng</h2>
										<ul class="list-style-none list-features">
											<li>Thông tin các đơn hàng bán trong ngày sẽ được tự động cập nhật liên tục.</li>
											<li>Quản lý chi tiết các phiếu nhập xuất kho, phiếu trả hàng khách, nhà cung cấp.</li>
											<li>Tự động đồng bộ đơn hàng từ website bán hàng online.</li>
											<li>Chúng tôi giúp bạn thống kê chính xác số lượng đơn hàng của từng cửa hàng.</li>
										</ul>
									</div>
								</div>
							</section>

							<section class=" no-mb  padding-big text-center-sm">
								<div class="row">
									<div class="col-md-5 col-md-offset-1">
										<h2 class="text-uppercase waa-heading-title">Quản lý nhân viên</h2>
										<ul class="list-style-none list-features">
											<li>Phân quyền chức năng cụ thể với từng nhân viên, nhóm nhân viên</li>
											<li>Đánh giá được hiệu quả bán hàng của từng nhân viên bán hàng</li>
											<li>Dễ dàng đánh giá hiệu quả công việc của nhân viên và chủ động đưa ra mức thưởng phù hợp với năng suất làm việc để khích lệ tinh thần</li>
										</ul>
									</div>

									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlnhanvien.jpg') }}">
									</div>
								</div>
							</section>

							<section class=" background-white no-mb padding-big text-center-sm">
								<div class="row">
									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlchinhanh.jpg') }}">
									</div>
									<div class="col-md-6">
										<h2 class="text-uppercase waa-heading-title">Quản lý chi nhánh</h2>
										<ul class="list-style-none list-features">
											<li>Cập nhật thông tin của nhà cung cấp nhanh chóng nếu có bất kỳ thay đổi nào.</li>
											<li>Theo dõi lịch sử nhập hàng của từng nhà cung cấp để đánh giá hiệu quả hoạt động nhập hàng.</li>
										</ul>
									</div>
								</div>
							</section>

							<section class=" no-mb  padding-big text-center-sm">
								<div class="row">
									<div class="col-md-5 col-md-offset-1">
										<h2 class="text-uppercase waa-heading-title">Quản lý công nợ, sổ quỹ</h2>
										<ul class="list-style-none list-features">
											<li>Theo dõi công nợ nhà cung cấp một cách chặt chẽ, trả nợ đúng hạn</li>
											<li>Theo dõi công nợ khách hàng cấp một cách chặt chẽ, trả nợ đúng hạn</li>
											<li>Quản lý thông tin phiếu thu, chi nhà cung cấp, khách hàng một cách chính xác và tự động</li>
										</ul>
									</div>

									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlphieuthuchi.jpg') }}">
									</div>
								</div>
							</section>

							<section class=" background-white no-mb padding-big text-center-sm">
								<div class="row">
									<div class="col-md-6 text-center">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/qlhoatdong.jpg') }}">
									</div>
									<div class="col-md-6">
										<h2 class="text-uppercase waa-heading-title">Quản lý lịch sử giao dịch</h2>
										<ul class="list-style-none list-features">
											<li>Mỗi hoạt động thao tác đến hệ thống được chúng tôi ghi lại lịch sử giao dịch nhằm giúp có thể theo dõi lại hoạt động được tương tác.</li>
										</ul>
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="statistic" class="waa-docs-section">
						<h2><i class="fa fa-pie-chart"></i> Quản lý thống kê</h2>
						<div class="waa-box-content">
							<div class="row">
								<div class="col-md-6">
									<div class="waa-photo">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/thongkeloinhuan.jpg') }}">
									</div>
									<div class="text-center">
										Hình 1.0: Biểu đồ thống kê doanh thu, lợi nhuận cửa hàng
									</div>
								</div>
								<div class="col-md-6">
									<div class="waa-photo">
										<img class="img-responsive" alt="" src="{{ asset('assets/img/waa/thongkedoanhsonhanvien.jpg') }}">
									</div>
									<div class="text-center">
										Hình 1.1: Biểu đồ thống kê doanh số bán hàng của từng nhân viên
									</div>
								</div>
							</div>
						</div>
					</section>

					<section id="orders" class="waa-docs-section">
						<h2><i class="fa fa-cart-plus"></i> Quản lý bán hàng</h2>
						<div class="waa-box-content">
							<section class="waa-photo">
								<img src="{{ asset('assets/img/waa/banhang.jpg') }}" alt="Tính năng nổi bật" class="img-responsive">
							</section>

							<section class="no-mb padding-big text-center-sm">
								<div class="row">
									<div class="col-md-6">
										<ul class="list-style-none list-features">
											<li><i class="fa fa-cart-plus"></i> Bán hàng tiện lợi nhanh chóng</li>
											<li><i class="fa fa-search"></i> Tìm kiếm hàng hóa thông minh</li>
											<li><i class="fa fa-money"></i> Điều chính giá bán theo từng sản phẩm</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list-style-none list-features">
											<li><i class="fa fa-cart-plus"></i> Bán hàng ngay cả khi ngắt kết nối internet</li>
											<li><i class="fa fa-support"></i> Vừa tư vấn vừa trực tiếp bán hàng</li>
											<li><i class="fa fa-calendar-o"></i> Quản lý giao hàng và quản lý hàng trả lại dễ dàng</li>
										</ul>
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="products" class="waa-docs-section">
						<h2><i class="fa fa-cubes"></i> Quản lý sản phẩm</h2>
						<div class="waa-box-content">
							<section class="no-mb padding-big text-center-sm">
								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlsanpham.jpg') }}" alt="Sản phẩm" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Tìm kiếm sản phẩm thông minh</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-eye"></i> Xem thông tin về sản phẩm: Mã sản phẩm, tên, giá bán, số lượng nhanh chóng</li>
											<li><i class="fa fa-search"></i> Tìm kiếm sản phẩm theo mã, theo tên sản phẩm</li>
											<li><i class="fa fa-pencil-square-o"></i> Hỗ trợ quản lý thông tin theo danh mục hàng hóa.</li>
										</ul>
									</div>
								</div>

								<div class="row list-item">
									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title"> Cập nhật thông tin dễ dàng</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-pencil-square-o"></i> Xem thông tin thay đổi ngay trên màn hình giao diện.</li>
											<li><i class="fa fa-pencil-square-o"></i> Cập nhật hàng hóa theo từng kho hàng một cách linh hoạt</li>
											<li><i class="fa fa-pencil-square-o"></i> Thay đổi thông tin dễ dàng</li>
										</ul>
									</div>

									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlnhomsanpham.jpg') }}" alt="Sản phẩm" class="img-responsive">
									</div>
								</div>

								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/nhapexcel.jpg') }}" alt="Sản phẩm" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Nhập suất sản phẩm nhanh bằng excel</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-cloud-upload"></i> Nhập sản phẩm nhanh qua hình thức tải excel theo mẫu</li>
											<li><i class="fa fa-cloud-download"></i> Xuất ra báo cáo chi tiết theo sản phẩm, danh mục hàng hóa dễ dàng</li>
											<li><i class="fa fa-history"></i> Đồng bộ sản phẩm tức thời từ website bán hàng Online</li>
										</ul>
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="stores" class="waa-docs-section">
						<h2><i class="fa fa-database"></i> Quản lý kho</h2>
						<div class="waa-box-content">
							<section class="no-mb padding-big text-center-sm">
								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlphieunhaphang.jpg') }}" alt="Nhập hàng" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Nhập xuất, bổ sung hàng hóa tiện dụng</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-upload"></i> Chủ động lên kết hoạch nhập hàng theo định mức tồn của hàng hóa</li>
											<li><i class="fa fa-search"></i> Tìm kiếm sản phẩm theo tên, mã sản phẩm tiện dụng</li>
											<li><i class="fa fa-search"></i> Số lượng hàng tồn thực tế trong kho sẽ nhanh chóng được nhập vào hệ thống quản lý</li>
										</ul>
									</div>
								</div>

								<div class="row list-item">
									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Luân chuyển hàng hóa</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-upload"></i> Chủ động tạo phiếu luân chuyển hàng hóa giữa các cửa hàng với nhau</li>
											<li><i class="fa fa-search"></i> Tìm kiếm sản phẩm theo tên, mã sản phẩm tiện dụng</li>
											<li><i class="fa fa-search"></i> Số lượng tự động bù trừ thực tế trong kho nhanh chóng</li>
										</ul>
									</div>

									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlphieuchuyenhang.jpg') }}" alt="Chuyển hàng" class="img-responsive">
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="staffs" class="waa-docs-section">
						<h2><i class="fa fa-users"></i> Quản lý nhân viên</h2>
						<div class="waa-box-content">
							<section class="no-mb padding-big text-center-sm">
								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlnhanvien.jpg') }}" alt="Nhập hàng" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Chức năng phân quyền</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-upload"></i> Phân quyền cho người dùng đúng theo từng bộ phận</li>
											<li><i class="fa fa-search"></i> Kiểm soát nhân viên được thực hiện chặt chẽ hơn</li>
											<li><i class="fa fa-users"></i> Mỗi nhân viên được cấp tài khoản và cấp quyền để thao tác phù hợp với vị trí công việc.</li>
										</ul>
									</div>
								</div>

								<div class="row list-item">
									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Thông tin nhân viên</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-upload"></i> Được lưu trữ chi tiết và đầy đủ trên hệ thống.</li>
											<li><i class="fa fa-code-fork"></i> Dữ liệu luôn được đồng bộ khi thay đổi</li>
											<li><i class="fa fa-recycle"></i> Thao tác, dễ dàng, nhanh chóng</li>
										</ul>
									</div>

									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/doithongtinnhanvien.jpg') }}" alt="Thay đổi thông tin" class="img-responsive">
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="branch" class="waa-docs-section">
						<h2><i class="fa fa-code-fork"></i> Quản lý chi nhánh, nhà cung cấp</h2>
						<div class="waa-box-content">
							<section class="no-mb padding-big text-center-sm">
								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlchinhanh.jpg') }}" alt="Quản lý chi nhanh" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Quản lý thông tin chi nhánh</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-eye"></i> Xem thông tin tất cả các chi nhánh</li>
											<li><i class="fa fa-code-fork"></i> Luân chuyển chi nhánh chính dễ dàng</li>
											<li><i class="fa fa-pencil-square-o"></i> Cập nhật thông tin chi nhánh</li>
										</ul>
									</div>
								</div>

								<div class="row list-item">
									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Quản lý nhà cung cấp</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-eye"></i> Xem thông tin nhà cung cấp</li>
											<li><i class="fa fa-pencil-square-o"></i> Cập nhật thông tin nhà cung cấp</li>
										</ul>
									</div>

									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlnhacungcap.jpg') }}" alt="Quản lý chi nhanh" class="img-responsive">
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="report" class="waa-docs-section">
						<h2><i class="fa fa-krw"></i> Quản lý báo cáo</h2>
						<div class="waa-box-content">
							<section class="no-mb padding-big text-center-sm">
								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlbaocaokho.jpg') }}" alt="Quản lý báo cáo" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Quản lý báo cáo</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-eye"></i> Thống kê báo lượng xuất, nhập tồn hàng hóa từng kho</li>
											<li><i class="fa fa-filter"></i> Thống kê lọc báo cáo theo khoảng thời gian lựa chọn</li>
										</ul>
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="debts" class="waa-docs-section">
						<h2><i class="fa fa-money"></i> Quản lý công nợ, sổ quỹ</h2>
						<div class="waa-box-content">
							<section class="no-mb padding-big text-center-sm">
								<div class="row list-item">
									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/qlphieuthuchi.jpg') }}" alt="Quản lý công nợ" class="img-responsive">
									</div>

									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Thông tin công nợ</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-eye"></i> Xem thông tin chi tiết về các khoản thu, chi</li>
											<li><i class="fa fa-filter"></i> Lọc thông tin công nợ theo khoảng thời gian lựa chọn</li>
											<li><i class="fa fa-file-excel-o"></i> Xuất công nợ theo excel</li>
										</ul>
									</div>
								</div>

								<div class="row list-item">
									<div class="col-md-5">
										<h2 class="text-uppercase waa-heading-title">Quản lý công nợ</h2>
										<ul class="list-style-none list-features">
											<li><i class="fa fa-eye"></i> Quản lý công nợ cần thu, cần chi</li>
											<li><i class="fa fa-pencil-square-o"></i> Tạo phiếu thu chi theo nhà cung cấp, khách hàng...</li>
										</ul>
									</div>

									<div class="col-md-7">
										<img src="{{ asset('assets/img/waa/taophieuthuchi.jpg') }}" alt="Quản lý công nợ" class="img-responsive">
									</div>
								</div>
							</section>
						</div>
					</section>

					<section id="history" class="waa-docs-section">
						<h2><i class="fa fa-history"></i> Quản lý lịch sử</h2>
						<div class="waa-box-content">
							<div class="row list-item">
								<div class="col-md-7">
									<img src="{{ asset('assets/img/waa/qlhoatdong.jpg') }}" alt="Quản lý lịch sử" class="img-responsive">
								</div>

								<div class="col-md-5">
									<h2 class="text-uppercase waa-heading-title">Quản lý lịch sử</h2>
									<ul class="list-style-none list-features">
										<li><i class="fa fa-list"></i> Danh sách hoạt động tương tác khi tương tác đến hệ thống</li>
										<li><i class="fa fa-eye"></i> Xem chi tiết lịch sử quá trình tương tác tới hệ thống.</li>
									</ul>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$('#nav').affix({
			offset: {
				bottom: ($('#footer').outerHeight(true)) + 200
			}
		});
		$(function() {
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: (target.offset().top - 80)
						}, 1000);
						return false;
					}
				}
			});
		});
	</script>
@stop