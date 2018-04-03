<ul class="list-unstyled">
   <li class="toggle-sidebar"><a href="#"><span class="sb-title">Danh mục quản trị</span></a> <a href="" class="btn btn-link"><i class="glyphicon glyphicon-transfer"></i></a></li>
   <li class="active">
      <a data-tab="tab-1" class="menu-item" href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span> <i class="fa fa-chevron-right pull-right"></i></a>
   </li>

   @if (Auth::getUser()->id == 1)
      <li>
         <a data-tab="tab-2" class="menu-item" href="{{ URL::to('admin/modules') }}"><i class="glyphicon glyphicon-cog"></i> <span>Admin modules</span> <i class="fa fa-chevron-right pull-right"></i></a>
      </li>
   @endif

   <?php
      // Modules listing
      //
      $modules = Fsd\Modules\Modules::where('active', 1)->get();
      $module_index = 3;
      foreach ($modules as $module) {

         // Ktra quyền view module trước khi show
         //
         $moduleName = explode('/', trim($module->link, '/'));
         $moduleName = end($moduleName);
         if (Fox::can($moduleName . ".view")):
         ?>
            <li>
               <a data-tab="tab-{{$module_index++}}" class="menu-item" href="{{ URL::to($module->link) }}"><i class="{{ $module->icon }}"></i> <span>{{ $module->name }}</span> <i class="fa fa-chevron-right pull-right"></i></a>
            </li>
         <?php
         endif;
      } // Endforeach
   ?>
</ul>