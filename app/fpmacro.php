<?php
/**
* Customize Form Builder Laravel Using Boostrap 3.*
* @author Lai Dao
* @Last Edit - 21/07/2014
*/

Form::macro('edit', function($route, $domain, $id) {
  return '<a href="' . route($route, [$domain, $id]) .'" class="btn  btn-default btn-flat btn-xs btn-control"
  title="Sửa">' . '<i class="fa fa-pencil"></i></a>';
});

Form::macro('delete', function($route, $id) {
  return '<a href="' . route($route, array('id' => $id)) . '" class="remove btn-flat btn btn-danger btn-xs btn-control"  title="Xóa">'
  . '<i class="fa fa-trash-o"></i></a>';
});