<?php
namespace Controllers\Admin;

use AdminController;
use View;
use Theme;
use Response;
use Request;
use Redirect;
use DataGrid;
use Input;
use App;
use Xss;
use Str;
use Validator;
use Fsd\Pages\Page;
use Fsd\Pages\PageRepository;

class PagesController extends AdminController {

	public function __construct(PageRepository $page) {

		parent::__construct();
		$this->page 	= $page;
	}

	public $positions = array(
		1 => 'Menu',
		2 => 'Footer',
		4 => 'Khác',
	);

	# Listing pages

	public function getIndex()	{

		$pages = $this->page->getAllPageByPaginate(25);

		$dataGrid = new DataGrid([
			'data' => $pages,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $pages->getTotal()
			]
		]);

		$dataGrid->addColumn('pag_id', 'ID', 1);
		$dataGrid->addColumn('pag_title', 'Tiêu đề', 1);

		$dataGrid->addColumn('', 'Trạng thái', 0, ['width' => 30], function($item) use($dataGrid){
			return $item->pag_active == 1 ? '<span class="text-success">Active</span>' : 'Deactive';
		});

		$dataGrid->addColumn('', 'Edit', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('page.edit', [$item->pag_id]));
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['pag_active'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/pages/active/'. $item['pag_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

		// $dataGrid->addColumn('', 'Act', 0, ['width' => 30], function($item) use($dataGrid) {
		// 	return $dataGrid->makeActiveButton(route('page.active' , [$item->pag_id]), [$item->pag_active]);
		// });

		$dataGrid->addColumn('', 'Delete', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('page.delete', [$item->pag_id]));
		});

		$data_grid = $dataGrid->render(false);

		return View::make('backend/pages/index', compact('data_grid'));
	}

	public function getEdit($id = 0) {
		if($id > 0) {
			$page = $this->page->getById($id);
		}else{
			$page = $this->page->getInstance();
		}

		if(!$page) return App::abort(404);

		if(Request::isMethod('post')) {
			return $this->postEdit($page);
		}

		$positions 	= $this->positions;
		//$pages 		= $this->page->getAllPagePublicSite();

		return View::make('backend/pages/edit', compact('page', 'positions'));
	}

	public function postEdit($page) {
		$rules = array(
			'pag_title'    => 'required|min:3',
			'pag_content'  => 'required|min:3',
			'pag_position' => 'required|integer|min:1'
		);

		 $messages = array(
			'pag_title.required'   => 'Bạn chưa nhập tiêu',
			'pag_content.required' => 'Nội dung không bỏ trống',
			'pag_content.required' => 'Nội dung không bỏ trống',
			'pag_position.min'			  => 'Vị trí không bỏ trống'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules, $messages);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$page->pag_title   		= Xss::clean(Input::get('pag_title'));
		$page->pag_content 		= Xss::clean(Input::get('pag_content'));
		$page->pag_position 		= (int) Input::get('pag_position');
		//$page->pag_parent 		= (int) Input::get('pag_parent');
		$page->pag_type    		= Page::PAGE_SITE_TYPE;
		$page->pag_active  		= Page::PAGE_ACTIVE;
		$page->pag_create_time	= time();
		$page->pag_update_time	= time();

		if ($page->save()) {
			return Redirect::route('page.index')->with('success', 'Thêm thành công.');
		}
		return Redirect::back()->with('error', 'Không thêm mới được');
	}

	public function getActive($id) {

		$page = $this->page->getById($id);

		if(!$page) return Redirect::to(route('page.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$page->pag_active = !$page->pag_active;

		if ($page->save()) {
			$json['status']	= $page->pag_active;
			$json['code']		= 1;
			$json['message']	= 'Cập nhật thành công';
			return Response::json($json);
		}
		else{
			$json['message'] = 'Cập nhật không thành công';
		}

		return Response::json($json);
	}

	# Method remove on pages

	public function getDelete($id)
	{
		$page = $this->page->getById($id);

		if(!$page) return Redirect::to(route('page.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$this->page->delete($page);

		return Redirect::to(route('page.index'))->with('success', 'Xóa thành công 1 bản ghi');
	}
}