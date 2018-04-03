@extends('dltl/layouts/master')

@section('content')

   <div class="container">
      <div id="wrapper_content">
         <div class="box-wapper row">
            <div class="col-sm-9" id="main-content">
               @include ('frontend/breadcrumbs')

               {{-- Box info list --}}
               <div class="box_right_item">
                  <div class="tour_big_title">
                     @if($q == '')
                        <h1 class="tour_heading_title" title="Danh sách tour du lịch">Danh sách tour du lịch</h1>
                     @else
                        <h1 class="tour_heading_title" title="Đặt tour du lịch">Tìm thấy {{ $tours->getTotal() }} kết quả với từ khóa "{{ Xss::clean(Input::get('q')) }}"</h1>
                     @endif
                  </div>

                  <div class="tour_filter_right_top">
                     <div>
                        <p>Có <span>{{ $tours->getTotal() }}</span> tour khởi hành theo ngày đã chọn</p>
                     </div>
                  </div>
               </div>

               {{-- Box list --}}
               @include('frontend/includes/listtour')
            </div>
            <div class="col-sm-3" id="aside">
               @include('frontend/includes/box_search')
            </div>
         </div>
      </div>
   </div>
@stop