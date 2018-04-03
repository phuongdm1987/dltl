@extends('backend/layouts/iframe')

{{-- Page content --}}
@section('content')
<div class="page-header">
   <h3>
      {{ $page->pag_id > 0 ? 'Sửa' : 'Thêm mới' }} page
      <div class="pull-right">
         <a href="javascript:window.history.back()" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
      </div>
   </h3>
</div>

{{ FM::openForm() }}
   <?php
      echo Form::token();
   ?>
   <div class="form-group {{ $errors->has('pag_title') ? 'has-error' : '' }}">
      <label class="col-sm-2 control-label">Tiêu đề</label>
      <div class="col-sm-6">
         {{ Form::text('pag_title', $page->pag_title, ['class' => 'form-control'] ) }}
         {{ $errors->first('pag_title', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

   {{-- <div class="form-group {{ $errors->has('pag_parent') ? 'has-error' : '' }}">
      <label class="control-label col-sm-2" for="type">Cấp danh mục</label>
      <div class="col-sm-6">
         <select name="pag_parent" id="pag_parent" class="form-control">
            <option value="0">-- Chọn danh mục --</option>
            @foreach($pages as $key => $p)
               <option value="{{ $p->pag_id }}" {{ $p->pag_id == $page->pag_parent ? 'selected' : '' }} >{{ $p->pag_title }}</option>
            @endforeach
         </select>
         {{ $errors->first('pag_parent', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div> --}}

   <div class="form-group {{ $errors->has('pag_position') ? 'has-error' : '' }}">
      <label class="control-label col-sm-2" for="type">Vị trí</label>
      <div class="col-sm-6">
         <select name="pag_position" id="pag_position" class="form-control">
            <option value="0">-- Chọn vị trí --</option>
            @foreach($positions as $key => $position)
               <option value="{{ $key }}" {{ $key == $page->pag_position ? 'selected' : '' }}>{{ $position }}</option>
            @endforeach
         </select>
         {{ $errors->first('pag_position', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

   <div class="form-group {{ $errors->has('pag_content') ? 'has-error' : '' }}">
      <label class="col-sm-2 control-label">Nội dung</label>
      <div class="col-sm-6">
         {{ Form::textarea('pag_content', $page->pag_content, ['class' => 'form-control content'] ) }}
         {{ $errors->first('pag_content', '<span class="help-inline text-danger">:message</span>') }}
      </div>
   </div>

   <?php
      echo FM::makeButton();
   ?>
{{ FM::closeForm() }}
@stop