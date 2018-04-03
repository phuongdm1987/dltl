<?php
namespace Controllers\Admin;

use AdminController;
use View;
use Products;
use Sentry;
use Redirect;
use Input;
use Validator;
use Grid;
use Category;
use Image;
use Config;
use Response;
use Colors;
use Attributes;
use Sizes;
use ProductDetails;
use ProductAttributes;
use ProductContents;
use ProductImages;
use App;
use Request;
use Orders;
use DataGrid;
use DB;
use PHPExcel;
use PHPExcel_IOFactory;
use ZipArchive;
use OrderProducts;

class OrdersController extends AdminController{

	protected $permission_prefix = 'orders';

	public function getIndex()
	{
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix.'.view')) {
         return App::abort('403');
      }

      $page    = Input::get('page', 1);
      $limit   = 25;
      $start   = $page * $limit - $limit;

      $orderby = !empty($_GET['field_sort']) ? $_GET['field_sort'] : 'ord_id';
      $order   = !empty($_GET['type_sort']) ? $_GET['type_sort'] : 'DESC';

      $sqlWhere = '';

      $ord_customer_name  = Input::get('ord_customer_name');
      $ord_customer_email = Input::get('ord_customer_email');
      $ord_customer_phone = Input::get('ord_customer_phone');
      $ord_code = Input::get('ord_code');

      if($ord_customer_name) {
         $sqlWhere .= ' AND ord_customer_name LIKE "%'. $ord_customer_name .'%" ';
      }

      if($ord_customer_email) {
         $sqlWhere .= ' AND ord_customer_email LIKE "%'. $ord_customer_email .'%"';
      }

      if($ord_customer_phone) {
         $sqlWhere .= ' AND ord_customer_phone LIKE "%'. $ord_customer_phone .'%"';
      }

      if($ord_code) {
         $sqlWhere .= ' AND ord_code = "'. $ord_code .'"';
      }

      $total = Orders::leftJoin('users', 'ord_user_id', '=', 'users.id')
                     ->leftJoin('order_status', 'ord_status_id', '=', 'ost_id')
                     ->leftJoin('cities', 'ord_shipping_city_id', '=', 'cit_id')
                     ->whereRaw(1 .' ' . $sqlWhere)
                     ->orderBy($orderby, $order)
                     ->count();

      $data = Orders::leftJoin('users', 'ord_user_id', '=', 'users.id')
                     ->leftJoin('order_status', 'ord_status_id', '=', 'ost_id')
                     ->leftJoin('cities', 'ord_shipping_city_id', '=', 'cit_id')
                     ->whereRaw(1 .' ' . $sqlWhere)
                     ->orderBy($orderby, $order)
                     ->skip($start)->limit($limit)->get();

      $grid = new DataGrid(array(
         'data' => $data,
         'pagination' => array(
            'total_record' => $total,
            'limit_record' => $limit
         )
      ));
      $grid->addSearch(1, 1, '', $grid->_formMaker->text(array('name' => 'ord_code', 'value' => Input::get('ord_code'), 'placeholder' => 'Mã hóa đơn')));
      $grid->addSearch(1, 2, '', $grid->_formMaker->text(array('name' => 'ord_customer_name', 'value' => Input::get('ord_customer_name'), 'placeholder' => 'Tên khách hàng')));
      $grid->addSearch(1, 3, '', $grid->_formMaker->text(array('name' => 'ord_customer_email', 'value' => Input::get('ord_customer_email'), 'placeholder' => 'Email khách hàng')));
      $grid->addSearch(1, 4, '', $grid->_formMaker->text(array('name' => 'ord_customer_phone', 'value' => Input::get('ord_customer_phone'), 'placeholder' => 'SĐT khách hàng')));
      $grid->addSearch(1, 5, '', $grid->_formMaker->text(array('name' => 'ord_create_date_start', 'value' => Input::get('ord_create_date_start'), 'placeholder' => 'Ngày tạo từ', 'class' => 'date-picker')));
      $grid->addSearch(1, 6, '', $grid->_formMaker->text(array('name' => 'ord_create_date_end', 'value' => Input::get('ord_create_date_end'), 'placeholder' => 'đến', 'class' => 'date-picker')));
      $stt = ($page - 1) * $limit;
      $grid->addColumn('', 'STT', 0, array(), function($item) use (&$stt) {
         return ++$stt;
      });
      $grid->addColumn('ord_time_updated', 'Cập nhật lúc', 1, array(), function($item) {
         return date('d/m/Y H:i:s', $item->ord_time_created);
      });
      $grid->addColumn('', 'Thông tin hóa đơn', 0, array(), function($item) {
         return '<table>
                     <tr>
                        <td>ID:</td>
                        <td>'. $item->ord_id .'</td>
                     </tr>
                     <tr>
                        <td>Mã hóa đơn</td>
                        <td>
                           <b class="label label-info">'. $item->ord_code .'</b>
                           <a href="'. $item->urlOrderProducts() .'">Xem chi tiết</a>
                        </td>
                     </tr>
                     <tr>
                        <td>Tổng tiền</td>
                        <td><b class="label label-danger">'. format_number($item->ord_total_money) .'đ</b></td>
                     </tr>
                     <tr>
                        <td>Trạng thái</td>
                        <td><b class="label label-success">'. $item->ost_name .'</b></td>
                     </tr>
                     <tr>
                        <td>ĐC ship hàng</td>
                        <td>'. $item->ord_shipping_address .'</td>
                     </tr>
                     <tr>
                        <td>Thành phố</td>
                        <td>'. $item->cit_name .'</td>
                     </tr>
                  </table>
               ';
      });

      $grid->addColumn('', 'Thông tin khách',0, array(), function($item) {
         return '<table>
                     <tr>
                        <td>Tên:</td>
                        <td><b>'. $item->ord_customer_name .'</b></td>
                     </tr>
                     <tr>
                        <td>Email:</td>
                        <td><b>'. $item->ord_customer_email .'</b></td>
                     </tr>
                     <tr>
                        <td>Phone:</td>
                        <td><b>'. $item->ord_customer_phone .'</b></td>
                     </tr>
                  </table>';
      });

      $data_grid = $grid->render(false);

      return View::make('backend/orders/index', compact('data_grid'));
	}


	public function getOrderProducts($ord_id) {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix.'.view')) {
         return App::abort('403');
      }


      $page    = Input::get('page', 1);
      $limit   = 25;
      $start   = $page * $limit - $limit;

      $total = OrderProducts::leftJoin('orders', 'opr_order_id', '=', 'ord_id')
                     ->leftJoin('products', 'opr_product_id', '=', 'pro_id')
                     ->whereRaw(1 .' AND opr_order_id = ' . $ord_id . ' ' . Grid::getQuerySearch())
                     ->orderBy(DB::raw(Grid::getQuerySort() . ' opr_id'), 'DESC')
                     ->count();

      $data = OrderProducts::leftJoin('orders', 'opr_order_id', '=', 'ord_id')
                     ->leftJoin('products', 'opr_product_id', '=', 'pro_id')
                     ->whereRaw(1 .' AND opr_order_id = ' . $ord_id . ' ' . Grid::getQuerySearch())
                     ->orderBy(DB::raw(Grid::getQuerySort() . ' opr_id'), 'DESC')
                     ->skip($start)->limit($limit)->get();

      $grid = new DataGrid(array(
         'data' => $data,
         'pagination' => array(
            'limit_record' => $limit,
            'total_record' => $total
         )
      ));

      $stt = ($page - 1) * $limit;

      $grid->addColumn('', 'STT', 0, array(), function($item) use (&$stt){
         return ++$stt;
      });

      $grid->addColumn('', 'Thông tin sản phẩm', 0, array(), function($item) {
         return '
            <table>
               <tr>
                  <td>Tên: </td>
                  <td><b>'. $item->pro_name .'</b></td>
               </tr>
               <tr>
                  <td>Ảnh</td>
                  <td>
                     <a href="'. refectObject('Products' ,$item->toArray())->getUrl() .'" target="_blank">
                        <img src="'. PATH_IMAGE_PRODUCT . 'sm_' . $item->pro_image .'">
                     </a>
                  </td>
               </tr>
            </table>
            ';
      });
      $grid->addColumn('', 'Thông tin phụ', 0, array(), function($item) {
         $product_child = ProductDetails::find($item->opr_product_child_id);
         if($product_child) {
            $size = Sizes::find($product_child->pde_size_id);
            $color = Colors::find($product_child->pde_color_id);
            return '<div> Màu sắc: '. $color->col_name .'</div>
                   <div> Kích cỡ: '. $size->siz_name .'</div>';
         }
      });
      $grid->addColumn('opr_quantity', 'Số lượng', 0, array(), function($item) {
         return format_number($item->opr_quantity);
      });
      $grid->addColumn('opr_price', 'Giá', 0, array(), function($item) {
         return format_number($item->opr_price);
      });
      $grid->addColumn('opr_total_money', 'Thành tiền', 0, array(), function($item) {
         return format_number($item->opr_total_money);
      });

      $data_grid = $grid->render(false);

      return View::make('backend/orders/detail', compact('ord_id', 'data_grid'));
	}

   public function getExportExcel() {
      return View::make('backend/orders/export-excel');
   }

   public function postExportExcel() {
      # Require PHPExcel libs
      require_once BASE_PATH . 'app/libs/PhpExcel_1.8.0/PHPExcel/IOFactory.php';
      require_once BASE_PATH . 'app/libs/PhpExcel_1.8.0/PHPExcel.php';

      # Get range date
      $str_date_start = Input::get('date_start');
      $str_hour_start = Input::get('hour_start', '00:00:00');
      $str_date_end   = Input::get('date_end');
      $str_hour_end   = Input::get('hour_end', '00:00:00');

      $array_date_start = explode('/', $str_date_start);
      $array_hour_start = explode(':', $str_hour_start);
      $array_date_end   = explode('/', $str_date_end);
      $array_hour_end   = explode(':', $str_hour_end);

      $date_start = mktime($array_hour_start[0], // Giờ
                           $array_hour_start[1], // Phút
                           $array_hour_start[2], // Giây
                           $array_date_start[1], // Tháng
                           $array_date_start[0], // Ngày
                           $array_date_start[2]  // Năm
                           );

      $date_end = mktime($array_hour_end[0], // Giờ
                         $array_hour_end[1], // Phút
                         $array_hour_end[2], // Giây
                         $array_date_end[1], // Tháng
                         $array_date_end[0], // Ngày
                         $array_date_end[2]  // Năm
                        );

      $orders = DB::select("SELECT * FROM orders
                           WHERE ord_time_created >= $date_start AND ord_time_created <= $date_end
                           ");

      $data_export = array();

      foreach($orders as $order) {
         $order_products = DB::select("SELECT * FROM order_products
                                      STRAIGHT_JOIN products ON opr_product_id = pro_id
                                      LEFT JOIN product_contents ON opr_product_id = pcon_product_id
                                      WHERE opr_order_id = " . $order->ord_id . "
                                      GROUP BY opr_order_id");

         foreach($order_products as $order_product) {
            $data_export[$order->ord_customer_phone][$order_product->opr_id] = array(
               'order_code'    => $order->ord_code,
               'customer_name' => $order->ord_customer_name,
               'customer_phone' => $order->ord_customer_phone,
               'customer_email' => $order->ord_customer_email,
               'customer_address' => $order->ord_customer_address,
               'order_date' => date('d/m/Y H:i:s', $order->ord_time_created),
               'link' => $order_product->pcon_url_source,
               'product_id' => $order_product->pro_id
            );
         }
      }

      $file_excels = array();

      foreach($data_export as $phone => $items) {
         $objExcel = new PHPExcel();

         // Do not send any more headers after this
         // flush();

         $objExcel->getProperties()
            ->setCreator("admin")
            ->setLastModifiedBy("admin")
            ->setKeywords('excel php product')
            ->setDescription('Dữ liệu đơn hàng waa được export từ CSDL');

         $objExcel->createSheet();

         // $objExcel->setActiveSheetIndex($sheetCount);
         $objExcel->setActiveSheetIndex();

         $objExcel->getActiveSheet()->setCellValue('A1', 'STT');
         $objExcel->getActiveSheet()->setCellValue('B1', 'Mã đơn hàng');
         $objExcel->getActiveSheet()->setCellValue('C1', 'Họ và tên');
         $objExcel->getActiveSheet()->setCellValue('D1', 'Phone');
         $objExcel->getActiveSheet()->setCellValue('E1', 'Email');
         $objExcel->getActiveSheet()->setCellValue('F1', 'Địa chỉ');
         $objExcel->getActiveSheet()->setCellValue('G1', 'Ngày đặt');
         $objExcel->getActiveSheet()->setCellValue('H1', 'Link');

         $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
         $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
         $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
         $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
         $objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
         $objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
         $objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
         $objExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);

         $objExcel->getDefaultStyle()->getFont()->setName('Arial');

         $i = 1;
         $stt = 0;

         foreach($items as $item) {
            $i ++;
            $stt ++;

            $objExcel->getActiveSheet()->setCellValue('A' . $i, $stt);
            $objExcel->getActiveSheet()->setCellValue('B' . $i, $item['order_code']);
            $objExcel->getActiveSheet()->setCellValue('C' . $i, $item['customer_name']);
            $objExcel->getActiveSheet()->setCellValue('D' . $i, $item['customer_phone']);
            $objExcel->getActiveSheet()->setCellValue('E' . $i, $item['customer_email']);
            $objExcel->getActiveSheet()->setCellValue('F' . $i, $item['customer_address']);
            $objExcel->getActiveSheet()->setCellValue('G' . $i, $item['order_date']);
            $objExcel->getActiveSheet()->setCellValue('H' . $i, $item['link']);
         }

         $export_filename = "Danh_sach_don_hang_khach_" . $phone . '.xls';
         $namefilecel = PHPExcel_IOFactory::createWriter($objExcel, "Excel5");
         $namefilecel->save(BASE_PATH . $export_filename);

         $objExcel->disconnectWorksheets();
         unset($objExcel);

         $file_excels[] = $export_filename;

      }

      # Tên file zip
      $file_zip = 'DS_Hoa_Don_' . str_replace('/', '_', $str_date_start) . '_Den_' . str_replace('/', '_', $str_date_end) . '.zip';

      # Gộp các file excel vào 1 file zip và download
      foreach($file_excels as $file) {
         $zip = new ZipArchive();
         $zip->open(BASE_PATH . $file_zip, ZipArchive::CREATE);
         $zip->addFile(BASE_PATH . $file, $file);
         $zip->close();
      }

      header('Content-type: application/zip');
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header('Content-Disposition: attachment; filename=' . basename($file_zip));
      header('Content-Length: '.filesize(BASE_PATH . $file_zip));
      readfile(BASE_PATH . $file_zip);

      # Xóa file tạm
      foreach($file_excels as $file) {
         @unlink(BASE_PATH . $file);
      }

      @unlink(BASE_PATH . $file_zip);

   }

}