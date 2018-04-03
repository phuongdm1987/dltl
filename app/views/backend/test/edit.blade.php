@extends('backend/layouts/iframe')
{{-- Page title --}}
@section('title')
Edit Test ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      Edit Test
      <div class="pull-right">
         <a href="javascript:window.history.go(-1)" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
   <p style="border-bottom:1px solid #ccc;padding-bottom:5px">Những ô có dấu <span class="text-danger">*</span> là bắt buộc phải nhập</p>
</div>

{{ FormCreator::openForm() }}
   <!-- CSRF Token -->
   {{ FormCreator::hidden(array('name' => '_token', 'value' => csrf_token())) }}

   <?php
      echo FormCreator::makeControl("Name", FormCreator::text(array("name" => "name", "value" => Input::old('name', $test->name) , "class" => "form-control")));
		echo FormCreator::makeControl("Age", FormCreator::text(array("name" => "age", "value" => Input::old('age', $test->age) , "class" => "form-control")));

      echo FormCreator::makeButton();
   ?>
{{ FormCreator::closeForm() }}
@stop
