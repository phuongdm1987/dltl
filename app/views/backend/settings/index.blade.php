@extends('backend/layouts/iframe')

@section('styles')
   <style>
      .form-horizontal h3 {font-weight: 300; font-size: 16px;}
   </style>
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>Configurations</h3>
</div>

<form action="" method="post" name="settings" class="form-horizontal" autocomplete="off" role="form">

   <input type="hidden" name="_token" value="{{ csrf_token() }}">

   <h3 class="text-muted">Metadata</h3>

   <div class="form-group{{ $errors->has('title') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="title">Tiêu đề</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="title" name="title" value="{{ Input::old('title', $settings->title) }}" placeholder="Meta title: Tiêu đề website">
         {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('keywords') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="keywords">Từ khóa</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="keywords" name="keywords" value="{{ Input::old('keywords', $settings->keywords) }}" placeholder="Meta keywords: Gồm các cụm 2 từ mô tả website">
         {{ $errors->first('keywords', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('description') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="description">Mô tả</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="description" name="description" value="{{ Input::old('description', $settings->description) }}" placeholder="Meta description: Giới hạn 80 từ">
         {{ $errors->first('description', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('ga_code') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="ga_code">Tracking code</label>
      <div class="col-sm-5">
         <textarea name="ga_code" id="ga_code" class="form-control" placeholder="Google analystic code, marketing code....">{{ Input::old('ga_code', $settings->ga_code) }}</textarea>
         {{ $errors->first('ga_code', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <h3 class="text-muted">Site info</h3>

   <div class="form-group{{ $errors->has('owner') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="owner">Tên công ty</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="owner" name="owner" value="{{ Input::old('owner', $settings->owner) }}">
         {{ $errors->first('owner', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('address') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="address">Địa chỉ</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="address" name="address" value="{{ Input::old('address', $settings->address) }}">
         {{ $errors->first('address', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('email') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="email">Email</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="email" name="email" value="{{ Input::old('email', $settings->email) }}">
         {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('phone') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="phone">Điện thoại</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="phone" name="phone" value="{{ Input::old('phone', $settings->phone) }}">
         {{ $errors->first('phone', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('skype') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="skype">Nick Skype</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="skype" name="skype" value="{{ Input::old('skype', $settings->skype) }}">
         {{ $errors->first('skype', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('yahoo') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="yahoo">Nick yahoo</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="yahoo" name="yahoo" value="{{ Input::old('yahoo', $settings->yahoo) }}">
         {{ $errors->first('yahoo', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('about') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="about">Giới thiệu công ty</label>
      <div class="col-sm-5">
         <textarea class="form-control" id="about" name="about">{{ Input::old('about', $settings->about) }}</textarea>
         {{ $errors->first('about', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <h3 class="text-muted">Social connecting</h3>

   <div class="form-group{{ $errors->has('facebook') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="facebook">Facebook</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="facebook" name="facebook" value="{{ Input::old('facebook', $settings->facebook) }}" placeholder="Đường dẫn trang cá nhân trên Facebook">
         {{ $errors->first('facebook', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('twitter') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="twitter">Twitter</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="twitter" name="twitter" value="{{ Input::old('twitter', $settings->twitter) }}" placeholder="Đường dẫn trang cá nhân trên Twitter">
         {{ $errors->first('twitter', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group{{ $errors->has('gplus') ? ' error' : '' }}">
      <label class="control-label col-sm-2" for="gplus">G+</label>
      <div class="col-sm-5">
         <input type="text" class="form-control" id="gplus" name="gplus" value="{{ Input::old('gplus', $settings->gplus) }}" placeholder="Đường dẫn trang cá nhân trên G+">
         {{ $errors->first('gplus', '<span class="help-inline">:message</span>') }}
      </div>
   </div>

   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-5">
         <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
      </div>
   </div>
</form>

@section('scripts')
<script>
   $(function() {
      $('.preview-uploader').click(function() {
         $('#logo').trigger('click');
      });

      $('#logo').change(fileSelect);
   });
</script>
@stop
@stop