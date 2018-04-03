@extends('frontend/layouts/tour')

@section('content')
   <div id="maincontent">
      <div id="wrapper_content">
         {{-- Box right --}}
         <div class="box_content_right">

            {{-- Box info list --}}

            <div class="box_right_item" style="border: 0; margin-top: 0; border-radius: 0; background-color: transparent;">
               <div class="tour_big_title" style="float: none!important;">
                  <h1 title="Danh sách tour của {{ $user->fullName() }}">Danh sách tour của <b>{{ $user->fullName() }}</b></h1>
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
               @include('frontend/includes/listtour')
            </div>
         </div>

         {{-- Box left --}}
         <div class="box_content_left">
				{{-- Box filter --}}
				<div id="fsd-box-user">
					<h2 title="Đăng bởi"><i class="fa fa-user" style="color: #1A96D2;"></i> Đăng bởi</h2>
					<section class="fsd-box-info">
						<div class="author-avatar text-center" style="background: url('{{ asset('assets/img/travel.jpg') }}') center center; background-size: cover; ">
							<a href="" style="background: url('{{ $user->getPictureAvatar() }}') center center; background-size: cover;"></a>
						</div>
						<div class="author-info">
							<a href="{{ $user->getUrlUser() }}" class="author-info-name">{{ $user->fullName() }}</a>
							<p class="author-phone"><i class="fa fa-phone-square"> </i> {{ $user->phone }}</p>
							<p class="author-email"><i class="fa fa-envelope-o"></i> {{ $user->email }}</p>
						</div>
					</section>
				</div>

            @include('frontend/includes/box_search')
         </div>
      </div>
   </div>
@stop