@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Thêm mới modules ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      Thêm module
      <div class="pull-right">
         <a href="{{ route('modules') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

<form class="form-horizontal" method="post" action="" autocomplete="off" role="form">
   <!-- CSRF Token -->
   <input type="hidden" name="_token" value="{{ csrf_token() }}" />

   <!-- Tabs Content -->
   <div class="tab-content">

      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="name">Module name</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name') }}" placeholder="VD: Quản lý bài viết..." />
            {{ $errors->first('name', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="link">Link</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="link" id="link" value="{{ Input::old('link') }}" placeholder="VD: /admin/posts" />
            {{ $errors->first('link', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="order">Order</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="order" id="order" value="{{ Input::old('order') }}" />
            {{ $errors->first('order', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="icon">Icon</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="icon" id="icon" value="{{ Input::old('icon') }}" placeholder="VD: glyphicon glyphicon-home,..." />
            {{ $errors->first('icon', '<span class="help-inline text-danger">:message</span>') }}
            <div>Support <a href="http://getbootstrap.com/components/#glyphicons" target="_blank">Bootstrap</a> &amp; <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Fontawesome</a> icons</div>
         </div>
      </div>
   </div>
   <p class="clearfix"></p>
   <!-- Form Actions -->
   <div class="form-group">
      <div class="col-sm-6 col-sm-offset-2">
         <a class="btn btn-link" href="{{ route('modules') }}">Hủy</a>

         <button type="reset" class="btn">Xóa dữ liệu</button>

         <button type="submit" class="btn btn-success">Tạo mới</button>
      </div>
   </div>
</form>
@stop
