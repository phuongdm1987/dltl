@extends('frontend/layouts/tour')

@section('content')
   <div id="maincontent">
      <div id="wrapper_content">
         {{-- Box right --}}
         <div class="box_content_right">

            {{-- Box info list --}}
            <div class="box_right_item" style="border: 0; margin-top: 0; border-radius: 0; background-color: transparent;">
               <div class="tour_big_title" style="float: none!important;">
                  <h1 title="Đặt tour du lịch {{ $place->pla_name }}">Tour đi qua {{ $place->pla_name }}</h1>
               </div>
               <div class="tour_filter_right_top">
                  <div>
                     <p style="font-size: 15px;">Có <span style="font-weight: bold; color: #00aeef;font-size: 16px;">{{ $tours->getTotal() }}</span> tour khởi hành theo ngày đã chọn</p>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>

            {{-- Box list --}}
            <div class="box_right_item list_result">
               <ul>
                  @foreach ($tours as $tour)
                     <li>
                        <div class="tour_result_item">
                           <div class="tour_result_item_left">
                              <div class="box_item_top">
                                 <h2 title="{{ $tour->tou_name }}"><a style="max-width: 520px;" href="{{ $tour->getUrl() }}">{{ $tour->tou_name }}</a></h2>
                              </div>
                              <div class="box_item_bottom">
                                 <div class="box_item_bottom_left">
                                    <a href="{{ $tour->getUrl() }}">
                                       <img alt="{{ $tour->tou_name }}" width="200" height="150" src="{{ $tour->getImage() }}">
                                    </a>
                                 </div>
                                 <div class="box_item_bottom_right">
                                    <div class="tour_short_des">
                                       <a title="" href="{{ $tour->getUrl() }}">
                                          <p>
                                             Ngày khởi hành:&nbsp;
                                             <span>Hàng ngày</span>
                                          </p>
                                          <p>Thời gian:&nbsp; <span>{{ $tour->tou_day }} ngày {{ $tour->tou_night }} đêm</span></p>
                                          <p>Điểm khởi hành:&nbsp;
                                             <span>{{ $tour->pla_name }}</span>
                                          </p>
                                          <p>Phương tiện:&nbsp; <span>{{ $tour->tou_vehicle }}</span></p>
                                       </a>
                                    </div>
                                 </div>
                                 <div class="clear"></div>
                              </div>
                              <div class="clear"></div>
                           </div>

                           <div class="tour_result_item_right">
                              <div class="tour_result_item_right_top">
                                 <div class="clear"></div>
                              </div>
                              <div class="tour_result_item_right_bottom">
                                 <div class="box_price">
                                    <p>Giá:</p>
                                    <p style="color: #318823; font-size: 18px"><span class="symbol_before"></span> <span class="price_show">{{ $tour->getPrice() }}</span> <span class="symbol_after">₫</span></p>
                                 </div>
                                 <a class="btn btn-primary btn-sm" href="{{ $tour->getUrl() }}">Xem tour</a>
                              </div>
                              <div class="clear"></div>
                           </div>
                           <div class="clear"></div>
                        </div>
                     </li>
                  @endforeach
               </ul>
               <div class="pull-right">
                  {{ $tours->links() }}
               </div>
               <div class="clearfix"></div>
            </div>
         </div>

         {{-- Box left --}}
         <div class="box_content_left">

            @include('frontend/includes/box_search')

         </div>
      </div>
   </div>
@stop