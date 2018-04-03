@extends('backend/layouts/iframe')

<?php
$form = new FormMaker(array('errors' => $errors));
$routesList = 'manufactories';
?>

{{-- Page title --}}
@section('title')
Sửa ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      Sửa ảnh nền
      <div class="pull-right">
         <a href="{{ route('backgrounds') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

{{ $form->openForm() }}
   <!-- CSRF Token -->
   {{ $form->hidden(array('name' => '_token', 'value' => csrf_token())) }}

   <!-- Tabs Content -->
   <div class="tab-content">

   	{{
   		$form->setTemplate('Ảnh', $form->image(array('src' => PATH_IMAGE_BACKGROUNDS  . $record->bac_image, 'width'=>'120', 'height'=>'120')));
   	}}

      {{
      	$form->setTemplate('Chọn logo', $form->file(array('name' => 'bac_image')));
      }}

      <div class="form-group {{ $errors->has('bac_position') ? 'has-error' : '' }}">
         <label class="control-label col-sm-2" for="type">Chọn vị trí</label>
         <div class="col-sm-6">
            <select name="bac_position" id="bac_position" class="form-control">
               <option value="">-- Chọn vị trí --</option>
               @foreach($positions as $key => $type)
                  <option value="{{ $key }}" {{ $key == Input::old('type', $record->bac_position) ? 'selected' : '' }}>{{ $type }}</option>
               @endforeach
            </select>
            {{ $errors->first('bac_position', '<span class="help-inline text-danger">:message</span>') }}
         </div>
      </div>

   </div>
   <p class="clearfix"></p>
   <!-- Form Actions -->
   <div class="form-group">
      <div class="col-sm-6 col-sm-offset-2">
         <a class="btn btn-link" href="{{ route($routesList) }}">Hủy</a>

         <button type="reset" class="btn">Xóa dữ liệu</button>

         <button type="submit" class="btn btn-success">Cập nhật</button>
      </div>
   </div>
{{ $form->closeForm() }}
@stop
