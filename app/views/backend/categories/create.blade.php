@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Thêm mới danh mục ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      Thêm danh mục
      <div class="pull-right">
         <a href="{{ route('categories') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

<form class="form-horizontal" method="post" action="" autocomplete="off" role="form" enctype="multipart/form-data">
   <!-- CSRF Token -->
   <input type="hidden" name="_token" value="{{ csrf_token() }}" />

   <!-- Tabs Content -->
   <div class="tab-content">

      <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="type">Loại danh mục</label>
         <div class="col-sm-6">
            <select name="type" id="type" class="form-control">
               <option value="0">-- Chọn loại danh mục --</option>
               @foreach($types as $key => $type)
                  <option value="{{ $key }}" {{ $key == Input::old('type') ? 'selected' : '' }}>{{ $type }}</option>
               @endforeach
            </select>
            {{ $errors->first('type', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('parents') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="parents">Danh mục cấp cha</label>
         <div class="col-sm-6">
            <select name="parents" id="parents" class="form-control">
               <option value="0">-- Chọn danh mục cha --</option>
               @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ $category->id == Input::old('parents') ? 'selected' : '' }}>
                     @for ($i = 0; $i < $category->level; $i++)
                        {{ ($i == 0 ? '|' : '') . '&rarr;' }}
                     @endfor
                     {{ $category->name }}
                  </option>
               @endforeach
            </select>
            {{ $errors->first('parents', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="name">Tên danh mục</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name') }}"/>
            {{ $errors->first('name', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('cat_background') ? 'has-error' : ''}}">
         <label class="control-label col-sm-2" for="cat_background">Mã màu</label>
         <div class="col-sm-6">
            <input type="text" class="form-control" name="cat_background" id="cat_background" value="{{ Input::old('cat_background') }}"/>
            {{ $errors->first('cat_background', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('cat_icon') ? 'has-error' : ''}}">
         <label class="control-label col-sm-2" for="cat_color">Icon</label>
         <div class="col-sm-6">
            <input type="file" name="cat_icon" id="cat_icon" value="{{ Input::old('cat_icon') }}"/>
            {{ $errors->first('cat_icon', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="description">Mô tả</label>
         <div class="col-sm-6">
            <textarea name="description" id="description" rows="5" class="form-control">{{ Input::old('description') }}</textarea>
            {{ $errors->first('description', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>
   </div>
   <p class="clearfix"></p>
   <!-- Form Actions -->
   <div class="form-group">
      <div class="col-sm-6 col-sm-offset-2">
         <a class="btn btn-link" href="{{ route('categories') }}">Hủy</a>

         <button type="reset" class="btn">Xóa dữ liệu</button>

         <button type="submit" class="btn btn-success">Tạo mới</button>
      </div>
   </div>
</form>
@stop
