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
                  <form name="tour_search" method="GET" id="tour_search" action="{{ route('search') }}">
                     <input type="text" class="text_search ui-autocomplete-input" id="tHomeSearch" name="q" placeholder="Nhập tên địa danh..." autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
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
            <div class="wrapper_content_top">
               <h2 title="Đặt tour du lịch trong nước">Tour trong nước</h2>
               <div class="data-line">
                  <div class="data_grid row col-md-10">
                  @foreach ($cityHotInLand as $city)
                     <div class="grid-home col-md-3 col-sm-6 col-xs-12">
                        <div class="data_grid_item">
                           <a title="{{ $city->cit_name }}" href="{{ route('tour.by.city', [$city->cit_id, removeTitle($city->cit_name)]) }}">
                              <div class="img_avatar">
                                 <img alt="{{ $city->cit_name }}" width="225" height="150" src="{{ $city->getImage() }}" data-size="225">
                              </div>
                              <div class="label_title">
                                 <h4>{{ $city->cit_name }}</h4>
                              </div>
                           </a>
                           {{-- <span class="tour_item_arrow"></span> --}}
                        </div>
                     </div>
                  @endforeach
                  </div>
                  <div class="box-go-to col-md-2">
                     <h2>Điểm đến</h2>
                     <div class="main-box">
                        <ul>
                           @foreach ($cities as $id => $city)
                              <li><a href="{{ route('tour.by.city', [$id, removeTitle($city)]) }}">{{ $city }}</a></li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="clear"></div>
               @if (count($countriesHotForeign) > 0)
                  <h2 title="Đặt tour du lịch trong nước">Tour nước ngoài</h2>
                  <div class="data-line">
                     <div class="data_grid row row col-md-10">
                     @foreach ($countriesHotForeign as $country)
                        <div class="grid-home col-md-3 col-sm-6 col-xs-12">
                           <div class="data_grid_item">
                              <a title="{{ $country->cou_name }}" href="{{ route('tour.by.country', [$country->cou_id, removeTitle($country->cou_name)]) }}">
                                 <div class="img_avatar">
                                    <img alt="{{ $country->cou_name }}" width="225" height="150" src="{{ $country->getImage() }}">
                                 </div>
                                 <div class="label_title">
                                    <h4>{{ $country->cou_name }}</h4>
                                 </div>
                              </a>
                              {{-- <span class="tour_item_arrow"></span> --}}
                           </div>
                        </div>
                     @endforeach
                     </div>
                     <div class="box-go-to col-md-2">
                        <h2>Điểm đến</h2>
                        <div class="main-box">
                           <ul>
                              @foreach ($countries as $id => $country)
                                 <li><a href="{{ route('tour.by.country', [$id, removeTitle($country)]) }}">{{ $country }}</a></li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                  </div>
               @endif
            </div>
         <div class="clear"></div>
      </div>
   </div>
@stop