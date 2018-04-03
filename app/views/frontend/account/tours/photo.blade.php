@extends('dltl/layouts/account')

@section('content')
<div class="header">
   <h3>{{ $tour->tou_name }}</h3>
   <div class="clearfix border-header">
      <hr class="hight-line">
      <hr class="">
   </div>
</div>
<section class="main-body">
	<ul id="list-photo" class="list-unstyled list-inline">
		@foreach($photos as $photo)
			<li class="photo-item">
				<img src="{{ PATH_IMAGE_TOUR . $photo->tim_tour_image }}">
				@if ($GLB_Login->check() && $tour->tou_user_id == $GLB_Login->getId())
					<a class="js_delete js_remover btn btn-xs" href="{{ route('account.photo.delete', [$photo->tim_id]) }}"><i class="fa fa-trash-o"></i></a>
				@endif
			</li>
		@endforeach
	</ul>
</section>
@stop