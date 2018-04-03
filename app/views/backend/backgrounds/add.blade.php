@extends('backend/layouts/iframe')

{{-- Page title --}}
@section('title')
Thêm mới ảnh nền ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      Thêm mới ảnh nền
      <div class="pull-right">
         <a href="{{ route('backgrounds') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

<form class="form-horizontal" method="post" action="" autocomplete="off" role="form" enctype="multipart/form-data">
   <!-- CSRF Token -->
   <input type="hidden" name="_token" value="{{ csrf_token() }}" />

   <!-- Tabs Content -->
   <div class="tab-content">
      <div class="form-group {{ $errors->has('bac_position') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="type">Chọn vị trí</label>
         <div class="col-sm-6">
            <select name="bac_position" id="bac_position" class="form-control">
               <option value="">-- Chọn vị trí --</option>
               @foreach($positions as $key => $type)
                  <option value="{{ $key }}" {{ $key == Input::old('type') ? 'selected' : '' }}>{{ $type }}</option>
               @endforeach
            </select>
            {{ $errors->first('bac_position', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

      <div class="form-group {{ $errors->has('bac_image') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="bac_image">Ảnh nền</label>
         <div class="col-sm-6">
            <input type="file" name="bac_image" id="bac_image" multiple="multiple"/>
            {{ $errors->first('bac_image', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

   </div>
   <p class="clearfix"></p>
   <!-- Form Actions -->
   <div class="form-group">
      <div class="col-sm-6 col-sm-offset-2">
         <a class="btn btn-link" href="{{ route('backgrounds') }}">Hủy</a>

         <button type="reset" class="btn">Xóa dữ liệu</button>

         <button type="submit" class="btn btn-success">Lưu lại</button>
      </div>
   </div>
</form>
@stop
