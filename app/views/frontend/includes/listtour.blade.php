<div class="clear"></div>
<div class="tour_filter_right_top tour_sorter clearfix">
	<ul id="filter-tour" class="list-unstyled list-inline pull-left">
		<li>Sắp xếp:</li>
		<li><a {{ ($sort == 1 ? 'class="active"' : '') }} href="{{ url_add_params(['sort' => 1]) }}">Giá tăng dần</a>&nbsp;&nbsp;|</li>
		<li><a {{ ($sort == 2 ? 'class="active"' : '') }} href="{{ url_add_params(['sort' => 2]) }}">Giá giảm dần</a>&nbsp;&nbsp;|</li>
		<li><a {{ ($sort == 3 ? 'class="active"' : '') }} href="{{ url_add_params(['sort' => 3]) }}">Đặt nhiều</a>&nbsp;&nbsp;|</li>
		<li><a {{ ($sort == 4 ? 'class="active"' : '') }} href="{{ url_add_params(['sort' => 4]) }}">Đánh giá cao</a></li>
	</ul>
	@if(isset($city) && isset($district) && isset($districts))
		<div class="dropdown pull-right">
			<button id="filter-city" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 	Quận huyện: {{ Input::get('district') == $district && Input::get('district') != 0 ? $dist->cit_name : 'Tất cả' }}
			 	<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="filter-city">
			 	<li><a href="{{ url_add_params(['district' => 0]) }}">Tất cả</a></li>
				@foreach($districts as $district)
					<li><a href="{{ url_add_params(['district' => $district->cit_id]) }}">{{ $district->cit_name }}</a></li>
				@endforeach
			</ul>
		</div>
	@endif
</div>
<div class="clear"></div>
<div class="box_right_item list_result">
	<ul id="fsd-box-list-tour" class="list-unstyled">
		@foreach ($tours as $tour)
			<li class="fsd-item-tour-result">
				<div class="tour_result_item">
					<div class="tour_result_item_left">
						<div class="box_item_top">
							<h2 title="{{ $tour->tou_name }}">
								<a href="{{ $tour->getUrl() }}">
								@if($tour->tou_hot == 1)
									<img src="{{ asset('/assets/img/icon-hot.gif') }}" alt="hot">
								@endif
									{{ $tour->tou_name }}
								</a>
							</h2>
						</div>
						<div class="box_item_bottom row">
							<div class="box_item_bottom_left col-sm-3">
								<a href="{{ $tour->getUrl() }}">
									<img alt="{{ $tour->tou_name }}" src="{{ $tour->getImage() }}">
								</a>
							</div>
							<div class="box_item_bottom_right col-sm-7">
								<div class="tour_short_des">
									<p>
										<strong>Ngày khởi hành:&nbsp;</strong>
										<span>
											{{ $tour->getTourStartType() }}
												<?php
													if ($tour->tou_start_type == 2 && $tour->tou_by_week != null) {
														$weeks_db = explode(',' , $tour->tou_by_week);
														$html = '';
														foreach($GLB_ByWeek as $key => $value) {
															if(in_array($key, $weeks_db)) {
																$html .= '<span class="tour-week btn btn-info btn-xs fsd-flat">'. $value .'</span>';
															}
														}
														echo  $html;
													}elseif($tour->tou_start_type == 3) {
														echo '<span class="tour-week btn btn-info btn-xs fsd-flat">'. date('d/m/Y', $tour->tou_start_time) .'</span>';
													}
												?>
										</span>
									</p>
									<p>
										<strong>Điểm khởi hành:&nbsp;</strong>
										<span>{{ $tour->cit_name }}</span>
									</p>
									<p>
										<strong>Địa danh đến:&nbsp;</strong>
										<span>{{ $tour->getPlace() }}</span>
									</p>
									<p><strong>Thời gian:&nbsp;</strong> <span>{{ $tour->tou_day }} ngày {{ $tour->tou_night }} đêm</span></p>
									<p><strong>Phương tiện:&nbsp;</strong> <span>{{ $tour->tou_vehicle }}</span></p>
									<p id="tag-post" class="tag-post">
										{{ $tour->getTags() != "" ? '<strong><i class="fa fa-tags"></i> Tags</strong>: ' . $tour->getTags() : "" }}
									</p>
								</div>
							</div>
							<div class="fsd_tour_result_item_right col-sm-2">
								<div class="box_price">
									<p>
										<span class="price_pub">{{ $tour->getPricePub() }} <sup>đ</sup></span>
									</p>
									<p>
										<span class="price_show">{{ $tour->getPrice() }} <sup>đ</sup></span>
									</p>
								</div>
								<a class="btn btn-success btn-sm fsd-flat read-more" href="{{ $tour->getUrl() }}">Chi tiết</a>
							</div>
						</div>
					</div>
				</div>
			</li>
		@endforeach
	</ul>
</div>
<div class="text-center">
	{{ $tours->appends(Input::all())->links() }}
</div>
<div class="clearfix"></div>