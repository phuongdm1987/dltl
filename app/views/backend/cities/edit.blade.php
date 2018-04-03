@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      {{ $city->cit_id > 0 ? 'Sửa' : 'Thêm mới' }} tỉnh thành phố
      <div class="pull-right">
         <a href="javascript:window.history.back()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

{{ FM::openForm() }}
   <?php
      echo Form::token();
   ?>
   <div class="form-group {{ $errors->has('cit_name') ? 'has-error' : '' }}">
      <label class="col-sm-2 control-label">Tên tỉnh thành phố</label>
      <div class="col-sm-6">
         {{ Form::text('cit_name', $city->cit_name, ['class' => 'form-control', 'placeholder' => 'Nhập tên tỉnh thành phố...']) }}
         {{ $errors->first('cit_name', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

   <div class="form-group {{ $errors->has('cit_country_id') ? 'has-error' : '' }}">
      <label class="control-label col-sm-2" for="cit_country_id">Quốc gia</label>
      <div class="col-sm-6">
         <select name="cit_country_id" id="cit_country_id" class="form-control">
            <option value="0">-- Chọn quốc gia --</option>
            @foreach($countries as $country)
               <option value="{{ $country->cou_id }}" {{ $country->cou_id == Input::old('cit_country_id', $city->cit_country_id) ? 'selected' : '' }}>{{ $country->cou_name }}</option>
            @endforeach
         </select>
         {{ $errors->first('cit_country_id', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

   <div class="form-group">
      <label for="pla_image" class="col-sm-2 control-label"></label>
      <div class="col-sm-8">
         <img src="{{ PATH_IMAGE_CITY . $city->cit_image }}" style="width: 150px;">
      </div>
   </div>

   {{--Ảnh--}}
   <div class="form-group {{ $errors->has('cit_image') ? 'has-error' : '' }}">
      <label for="cit_image" class="col-sm-2 control-label">Ảnh đại diện</label>
      <div class="col-sm-6">
         <input type="file" name="cit_image">
         {{ $errors->first('cit_image', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

   <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
         <button type="submit" class="btn btn-danger btn-sm"> {{ $city->cit_id > 0 ? 'Cập nhật' : 'Thêm mới' }} </button>
      </div>
   </div>
{{ FM::closeForm() }}
@stop