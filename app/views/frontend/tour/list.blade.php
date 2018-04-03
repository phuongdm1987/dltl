@extends('frontend/layouts/tour')

@section('content')
   <div id="maincontent">
      <div id="wrapper_content">
         {{-- Box right --}}
         <div class="box_content_right">

            {{-- Box info list --}}
            <div class="box_right_item" style="border: 0; margin-top: 0; border-radius: 0; background-color: transparent;">
               <div class="tour_big_title" style="float: none!important;">
                  <h1 title="Đặt tour du lịch Đà Lạt">Tour đi qua Đà Lạt</h1>
               </div>
               <div class="tour_filter_right_top">
                  <div>
                     <p style="font-size: 15px;">Có <span style="font-weight: bold; color: #00aeef;font-size: 16px;">25</span> tour khởi hành theo ngày đã chọn</p>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>
            
            {{-- Box sort --}}
            <div class="box_right_item filter_bar">
               <ul>
                  <li><a class="filter_bar_active" href="/tour/d352/tour-du-lich-da-lat.html">Phổ biến nhất</a></li>
                  <li>
                     <a class="" href="/tour/d352/tour-du-lich-da-lat.html?filter=1">Giá</a>
                     <ul style="display: none;">
                        <li><a href="/tour/d352/tour-du-lich-da-lat.html?filter=1">Tăng dần</a></li>
                        <li><a href="/tour/d352/tour-du-lich-da-lat.html?filter=2">Giảm dần</a></li>
                     </ul>
                  </li>
                  <li>
                     <a class="" href="/tour/d352/tour-du-lich-da-lat.html?filter=3">Số ngày</a>
                     <ul>
                        <li><a href="/tour/d352/tour-du-lich-da-lat.html?filter=3">Ngắn ngày</a></li>
                        <li><a href="/tour/d352/tour-du-lich-da-lat.html?filter=4">Dài ngày</a></li>
                     </ul>
                  </li>
                  <li>
                     <a class="" href="/tour/d352/tour-du-lich-da-lat.html?filter=5">Sắp khởi hành</a>
                  </li>
                  <li><a class="" href="/tour/d352/tour-du-lich-da-lat.html?filter=6">Đánh giá cao</a></li>
                  <li><a class="" href="/tour/d352/tour-du-lich-da-lat.html?filter=7">Khuyến mãi</a></li>
               </ul>
               <div class="clear"></div>
            </div>

            {{-- Box list --}}
            <div class="box_right_item list_result">
               <ul>
                  @for ($i=0; $i < 10; $i++)
                     <li>
                        <div class="tour_result_item">
                           <div class="tour_result_item_left">
                              <div class="box_item_top">
                                 <h2 title="City Tour Đà Lạt 1 ngày"><a style="max-width: 520px;" href="http://mytour.vn/tour/34-city-tour-da-lat-1-ngay.html">City Tour Đà Lạt 1 ngày</a></h2>
                              </div>
                              <div class="box_item_bottom">
                                 <div class="box_item_bottom_left">
                                    <a href="http://mytour.vn/tour/34-city-tour-da-lat-1-ngay.html">
                                       <img alt="City Tour Đà Lạt 1 ngày" width="200" height="150" src="http://static.mytour.vn:8080/pictures/tours/medium_wnj1338447545.jpg">
                                    </a>
                                    <p style="margin-top: 5px;">
                                       <a onclick="return false;" data-id="34" data-name="City Tour Đà Lạt 1 ngày" data-link="http://mytour.vn/tour/34-city-tour-da-lat-1-ngay.html" class="add_tour_compare">So sánh</a>
                                       <a href="javascript: ;" onclick="windowPrompt({href: '/ajax/load_tour_schedule.php?tour_id=34', iframe: true, width: '720px', height: '480px'})">Lịch trình</a>
                                    </p>
                                 </div>
                                 <div class="box_item_bottom_right">
                                    <div class="tour_attr">
                                       <a href="http://mytour.vn/tour/34-city-tour-da-lat-1-ngay.html">
                                          <i class="t_attr_icon t_icon_1" title="Hướng dẫn viên"></i>
                                          <i class="t_attr_icon t_icon_2" title="Vé thăm quan"></i>
                                          <i class="t_attr_icon t_icon_4" title="Xe đưa đón"></i>
                                          <i class="t_attr_icon t_icon_16" title="Bảo hiểm"></i>
                                          <div class="clear"></div>
                                       </a>
                                       <div class="clear"></div>
                                    </div>
                                    <div class="tour_short_des">
                                       <a title="" href="http://mytour.vn/tour/34-city-tour-da-lat-1-ngay.html">
                                          <p>
                                             Ngày khởi hành:&nbsp;
                                             <span>Hàng ngày</span>
                                          </p>
                                          <p>Thời gian:&nbsp; <span>1 ngày 0 đêm</span></p>
                                          <p>Điểm khởi hành:&nbsp; 
                                             <span>Lâm Đồng-Việt Nam</span>
                                          </p>
                                          <p>Phương tiện:&nbsp; <span>Ôtô</span></p>
                                       </a>
                                    </div>
                                 </div>
                                 <div class="clear"></div>
                              </div>
                              <div class="clear"></div>
                           </div>
                           
                           <div class="tour_result_item_right">
                              <div class="tour_result_item_right_top">
                                 <div class="show_rate_score">
                                    <a href="http://rvtour.dev">
                                       <p>Rất tốt</p>
                                       <p>9.0</p>
                                       <p>(1 đánh giá)</p>
                                    </a>
                                 </div>
                                 <div class="clear"></div>
                              </div>
                              <div class="tour_result_item_right_bottom">
                                 <div class="box_price">
                                    <p>Giá:</p>
                                    <p style="color: #318823; font-size: 18px"><span class="symbol_before"></span> <span data="300000" class="price_show">300,000</span> <span class="symbol_after">₫</span></p>
                                 </div>
                                 <a class="view_tour_detail" href="http://mytour.vn/tour/34-city-tour-da-lat-1-ngay.html">Xem tour</a>
                              </div>
                              <div class="clear"></div>
                           </div>
                           <div class="clear"></div>
                        </div>
                     </li>
                  @endfor
               </ul>
            </div>
         </div>

         {{-- Box left --}}
         <div class="box_content_left">
         
            {{-- Box search --}}
            <div class="box_search_left">
               <div class="box_title mytour_title">
                  <h2 title="Tìm tour">Tìm tour</h2>
               </div>
               <div class="box_left_item_container">
                  <form id="tour_search" style="position: relative;" name="tour_search" action="" method="GET" onsubmit=""> 
                     <div class="form_item">
                        <input type="text" name="key_search" id="tSearch" class="text_search ui-autocomplete-input" placeholder="Bạn muốn đi du lịch ở đâu?" value="" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                     </div>
                     <div class="form_item">
                        <div class="select_start_point" name="start_point">
                           <span class="select_label">Điểm khởi hành</span>
                           <input type="hidden" name="tou_start_city" value="0">
                           <ul class="list_option">
                              <li value="2">Hà Nội</li>
                                 <li value="3">Hồ Chí Minh (Sài Gòn)</li>
                                 <li value="65">Đà Nẵng</li>
                                 <li value="38">Lâm Đồng</li>
                                 <li value="19">Thừa Thiên Huế</li>
                                 <li value="17">Khánh Hòa</li>
                                 <li value="35">Kiên Giang</li>
                                 <li value="47">Quảng Nam</li>
                                 <li value="46">Quảng Bình</li>
                                 <li value="68">Hậu Giang</li>
                           </ul>
                        </div>
                     </div>
                     <div class="form_item">
                        <p>Khoảng thời gian khởi hành:</p>
                        <input type="text" name="timefrom" value="20/05/2015" class="select_date date_start time_box width_112 hasDatepicker" id="dp1432311078531">
                        <input type="text" name="timeto" value="19/07/2015" class="select_date date_end time_box width_112 hasDatepicker" id="dp1432311078532">
                     </div>
                     <div class="form_item">
                        <input type="submit" id="submit" class="btn_search_left" value="Tìm">
                     </div>
                  </form>
               </div>
               <div class="clear"></div>
            </div>

            {{-- Box filter --}}
            <div class="box_left_item">
               <div class="box_title">
                  <h2 title="Chọn tiêu chí để lọc kết quả">Chọn tiêu chí để lọc kết quả</h2>
               </div>
               <div class="box_left_item_container box_left_menu">
                  <ul class="ul_menu tour_filter">
                  <!--                     BOX filter theo mức giá                         -->
                     <li class="li_menu_item">
                        <div class="menu_title">
                           <h3>Theo mức giá</h3>
                           <span class="arrow_icon unexpand"></span>
                        </div>
                        <ul class="ul_sub_menu price_filter" style="display: block;">
                           <li style="padding-left: 10px;">
                              <form action="" method="GET" name="price_filter" enctype="">
                                 <div class="select_start_point" name="start_point">
                                    <span class="select_label">Tất cả</span>
                                    <input type="hidden" name="selected_value" value="1">
                                    <ul style="z-index: 100;" class="list_option">
                                       <li onclick="filter_price(0);" value="0">Tất cả</li>
                                          <li onclick="filter_price(1);" value="1">0-2000k</li>
                                          <li onclick="filter_price(2);" value="2">2000k-4000k</li>
                                          <li onclick="filter_price(3);" value="3">4000k-6000k</li>
                                          <li onclick="filter_price(4);" value="4">6000k-8000k</li>
                                          <li onclick="filter_price(5);" value="5">8000k-10000k</li>
                                          <li onclick="filter_price(6);" value="6">Trên 10000k</li>
                                       </ul>
                                 </div>
                              </form>
                           </li>
                        </ul>
                     </li>

                     <li class="li_menu_item">
                        <div class="menu_title">
                           <h3>Dịch vụ đi kèm</h3>
                           <span class="arrow_icon unexpand"></span>
                        </div>
                        <ul class="ul_sub_menu" style="display: block;">
                           <li><a class=" filter_normal_39" data-value="1" href="javascript:;" onclick="filter_attribute(this, 39);">Hướng dẫn viên</a></li>
                              <li><a class=" filter_normal_39" data-value="2" href="javascript:;" onclick="filter_attribute(this, 39);">Vé thăm quan</a></li>
                              <li><a class=" filter_normal_39" data-value="4" href="javascript:;" onclick="filter_attribute(this, 39);">Xe đưa đón</a></li>
                              <li><a class=" filter_normal_39" data-value="8" href="javascript:;" onclick="filter_attribute(this, 39);">Bữa ăn theo chương trình</a></li>
                              <li><a class=" filter_normal_39" data-value="16" href="javascript:;" onclick="filter_attribute(this, 39);">Bảo hiểm</a></li>
                              <li><a class=" filter_normal_39" data-value="32" href="javascript:;" onclick="filter_attribute(this, 39);">Hỗ trợ người khuyết tật</a></li>
                        </ul>
                     </li>
                     <li class="li_menu_item">
                        <div class="menu_title">
                           <h3>Tour theo chủ đề</h3>
                           <span class="arrow_icon unexpand"></span>
                        </div>
                        <ul class="ul_sub_menu" style="display: block;">
                           <li><a class=" filter_normal_46" data-value="64" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch khám phá</a></li>
                              <li><a class=" filter_normal_46" data-value="128" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch biển đảo</a></li>
                              <li><a class=" filter_normal_46" data-value="256" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch mua sắm, lễ hội</a></li>
                              <li><a class=" filter_normal_46" data-value="512" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch Liên Tuyến, Xuyên Việt</a></li>
                              <li><a class=" filter_normal_46" data-value="1024" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch tuần trăng mật</a></li>
                              <li><a class=" filter_normal_46" data-value="2048" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch gia đình</a></li>
                              <li><a class=" filter_normal_46" data-value="1" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch nghỉ dưỡng</a></li>
                              <li><a class=" filter_normal_46" data-value="2" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch hành hương</a></li>
                              <li><a class=" filter_normal_46" data-value="4" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch cho người cao tuổi</a></li>
                              <li><a class=" filter_normal_46" data-value="8" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch miền Bắc</a></li>
                              <li><a class=" filter_normal_46" data-value="16" href="javascript:;" onclick="filter_attribute(this, 46);">Du  lịch miền Trung</a></li>
                              <li><a class=" filter_normal_46" data-value="32" href="javascript:;" onclick="filter_attribute(this, 46);">Du lịch miền Nam</a></li>
                        </ul>
                     </li>
                     <li class="li_menu_item">
                        <div class="menu_title">
                           <h3>Loại tour</h3>
                           <span class="arrow_icon unexpand"></span>
                        </div>
                        <ul class="ul_sub_menu" style="display: block;">
                           <li><a class=" filter_normal_45" data-value="1" href="javascript:;" onclick="filter_attribute(this, 45);">Trọn gói</a></li>
                              <li><a class=" filter_normal_45" data-value="2" href="javascript:;" onclick="filter_attribute(this, 45);">Chỉ vé máy bay và khách sạn</a></li>
                              <li><a class=" filter_normal_45" data-value="4" href="javascript:;" onclick="filter_attribute(this, 45);">Không vé máy bay</a></li>
                              <li><a class=" filter_normal_45" data-value="8" href="javascript:;" onclick="filter_attribute(this, 45);">Tour khởi hành hàng ngày</a></li>
                              <li><a class=" filter_normal_45" data-value="16" href="javascript:;" onclick="filter_attribute(this, 45);">Tour đoàn dành cho doanh nghiệp</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>

            {{-- Box Location --}}
            <div class="box_left_item">
               <div class="box_title">
                  <h2 title="Điểm đến phổ biến">Điểm đến phổ biến</h2>
               </div>
               <div class="box_left_item_container box_left_menu">
                  <ul id="ul_popular" class="ul_menu">
                     <li class="li_menu_item">
                         <div title="Miền Bắc" class="menu_title son_menu_title">
                             <p>Miền Bắc</p><span class="arrow_icon unexpand"></span>
                         </div>
                         <ul class="ul_sub_menu" style="display: block;">
                           <li><a title="Hải Phòng" href="http://mytour.vn/tour/c32/tour-du-lich-hai-phong.html">Hải Phòng</a></li>
                           <li><a title="Hà Nội" href="http://mytour.vn/tour/c2/tour-du-lich-ha-noi.html">Hà Nội</a></li>
                           <li><a title="Hòa Bình" href="http://mytour.vn/tour/c33/tour-du-lich-hoa-binh.html">Hòa Bình</a></li>
                           <li><a title="Quảng Ninh" href="http://mytour.vn/tour/c21/tour-du-lich-quang-ninh.html">Quảng Ninh</a></li>
                           <li><a title="Sơn La" href="http://mytour.vn/tour/c51/tour-du-lich-son-la.html">Sơn La</a></li>
                           <li><a title="Ninh Bình" href="http://mytour.vn/tour/c42/tour-du-lich-ninh-binh.html">Ninh Bình</a></li>
                           <li><a title="Lào Cai" href="http://mytour.vn/tour/c20/tour-du-lich-lao-cai.html">Lào Cai</a></li>
                           <li><a title="Vĩnh Phúc" href="http://mytour.vn/tour/c60/tour-du-lich-vinh-phuc.html">Vĩnh Phúc</a></li>
                           <li><a title="Thanh Hóa" href="http://mytour.vn/tour/c55/tour-du-lich-thanh-hoa.html">Thanh Hóa</a></li>
                        </ul>
                     </li>
                     <li class="li_menu_item">
                         <div title="Miền Trung" class="menu_title son_menu_title">
                             <p>Miền Trung</p><span class="arrow_icon expand"></span>
                         </div>
                         <ul class="ul_sub_menu" style="display: none;">
                           <li><a title="Nghệ An" href="http://mytour.vn/tour/c41/tour-du-lich-nghe-an.html">Nghệ An</a></li>
                           <li><a title="Huế" href="http://mytour.vn/tour/c19/tour-du-lich-hue.html">Huế</a></li>
                           <li><a title="Quảng Nam" href="http://mytour.vn/tour/c47/tour-du-lich-quang-nam.html">Quảng Nam</a></li>
                           <li><a title="Quảng Bình" href="http://mytour.vn/tour/c46/tour-du-lich-quang-binh.html">Quảng Bình</a></li>
                           <li><a title="Hà Tĩnh" href="http://mytour.vn/tour/c30/tour-du-lich-ha-tinh.html">Hà Tĩnh</a></li>
                           <li><a title="Đà Nẵng" href="http://mytour.vn/tour/c65/tour-du-lich-da-nang.html">Đà Nẵng</a></li>
                        </ul>
                     </li>
                     <li class="li_menu_item">
                         <div title="Miền Nam" class="menu_title son_menu_title">
                             <p>Miền Nam</p><span class="arrow_icon expand"></span>
                         </div>
                         <ul class="ul_sub_menu">
                           <li><a title="Vũng Tàu" href="http://mytour.vn/tour/c5/tour-du-lich-vung-tau.html">Vũng Tàu</a></li>
                           <li><a title="Hồ Chí Minh" href="http://mytour.vn/tour/c3/tour-du-lich-ho-chi-minh.html">Hồ Chí Minh</a></li>
                           <li><a title="Bình Thuận" href="http://mytour.vn/tour/c11/tour-du-lich-binh-thuan.html">Bình Thuận</a></li>
                           <li><a title="Khánh Hòa" href="http://mytour.vn/tour/c17/tour-du-lich-khanh-hoa.html">Khánh Hòa</a></li>
                           <li><a title="Ninh Thuận" href="http://mytour.vn/tour/c43/tour-du-lich-ninh-thuan.html">Ninh Thuận</a></li>
                           <li><a title="Kiên Giang" href="http://mytour.vn/tour/c35/tour-du-lich-kien-giang.html">Kiên Giang</a></li>
                           <li><a title="Cần Thơ" href="http://mytour.vn/tour/c15/tour-du-lich-can-tho.html">Cần Thơ</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
@stop