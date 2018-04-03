@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Thêm mới banner ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      {{ $id > 0 ? 'Sửa' : 'Thêm' }} banner
      <div class="pull-right">
         <a href="{{ route('banner') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

{{ FM::openForm() }}
   <!-- CSRF Token -->
   {{ Form::token() }}

   <?php
      if($action == 'edit') {
         echo FM::makeControl('', FM::image(['src' => PATH_BANNER . $banner->ban_picture, 'height' => 50]));
      }
      echo FM::makeControl('Ảnh', FM::file(['name' => 'ban_picture']));
      echo FM::makeControl('Link', FM::text(['name' => 'ban_link', 'value' => Input::old('ban_link', $banner->ban_link)]));
      echo FM::makeControl('Màu nền', FM::text(['name' => 'ban_background', 'value' => Input::old('ban_background', $banner->ban_background), 'placeholder' => 'Mã màu']));
      echo FM::makeControl('Trang cần đặt', FM::select($configBannerPage, Input::old('ban_page', $banner->ban_page), ['name' => 'ban_page']));
      echo FM::makeControl('Vị trí', FM::select($configBannerPosition, Input::old('ban_position', $banner->ban_position), ['name' => 'ban_position']));
      echo FM::makeButton();

      // Don't remove two lines
      echo FM::hidden(['name' => 'action', 'value' => $action]);
      echo FM::hidden(['name' => 'id', 'value' => $banner->ban_id]);
   ?>

{{ FM::closeForm() }}
@stop
