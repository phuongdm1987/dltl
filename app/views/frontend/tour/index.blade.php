@extends('frontend/layouts/tour')

@section('content')
   <div id="wrapper_top">
      <div class="wrapper_banner">
         <div class="box_center">
            <div class="tour_over_intro">
               <h1 title="Đặt tour du lịch Việt Nam và quốc tế">Bạn muốn du lịch ở đâu?</h1>
            </div>
            <div class="box_search_tour">
               <div class="tour_search_bar">
                  <form name="tour_search" method="GET" id="tour_search" action="/tour/search.php" enctype="" onsubmit="return check_from_tour(this);">
                     <input type="text" class="text_search ui-autocomplete-input" id="tHomeSearch" name="keyword" placeholder="Nhập tên địa danh..." autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                     <input type="submit" class="btnSubmit" id="btnSubmit" value="Tìm">
                     <!-- <ul class="tour_search_result"></ul> -->
                  </form>
               </div>
            </div>
         </div>
      </div>
      <ul id="tour_slider_home_top">
         <li>
            <img src="{{ asset('assets/img/demo_slide.jpg') }}">
         </li>
      </ul>
   </div>
   <div id="maincontent" class="container-fluid">
      <div id="wrapper_content"><!-- WRAPPER -->

         @foreach ($tourTypes as $type)
            <div class="wrapper_content_top">
               @if ($type == \Fsd\Tours\Tour::TYPE_INLAND)
                  <h2 title="Đặt tour du lịch trong nước">Tour trong nước</h2>
               @endif
               @if ($type == \Fsd\Tours\Tour::TYPE_FOREIGN)
                  <h2 title="Đặt tour du lịch nước ngoài">Tour nước ngoài</h2>
               @endif

               @if (isset($tours[$type]))
                  <div class="data_grid row">
                  @foreach ($tours[$type] as $tour)
                     <div class="grid-home col-md-3 col-sm-6 col-xs-12">
                        <div class="data_grid_item">
                           <a title="{{ $tour->tou_name }}" href="{{ $tour->getUrl() }}">
                              <div class="img_avatar">
                                 <img alt="{{ $tour->tou_name }}" width="225" height="150" src="{{ $tour->getImage() }}">
                              </div>
                              <div class="label_title">
                                 <h4>{{ $tour->tou_name }}</h4>
                              </div>
                           </a>
                           <span class="tour_item_arrow"></span>
                        </div>
                     </div>
                  @endforeach
                  </div>
               @endif
            </div>
         @endforeach
         <div class="clear"></div>
      </div>
   </div>
@stop