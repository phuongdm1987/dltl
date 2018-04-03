<?php namespace Controllers\Admin;

use AdminController;
use View;
use Redirect;
use Validator;
use Input;
use Sentry;
use App;
use Response;
use Image;
use Config;
use Fsd\Categories\Category;
use Fsd\Categories\CategoryRepository;

class CategoriesController extends AdminController {

		public function __construct(CategoryRepository $mCategory) {
			parent::__construct();
			$this->mCategory = $mCategory;
		}

	// protected $permission_prefix = 'categories';

	/**
	 * Mảng lưu các kiểu category (menu, sp thời trang, sp gia đình...)
	 * Constanst được định nghĩa trong file config/constant.php
	 */
	public $category_types = array(
		1 => 'Sản phẩm',
		2 => 'Menu',
		3 => 'Tin tức'
	);


	/**
	 * Listing page
	 */
	public function getIndex() {

		$categories = $this->mCategory->getListChilds();

		return View::make('backend/categories/index', compact('categories'));
	}

	/**
	 * Create a category
	 */
	public function getCreate() {

		$types = $this->category_types;

		$categories = $this->mCategory->getListChilds();

		return View::make('backend/categories/create', compact('types', 'categories'));
	}

	/**
	 * Create a category process
	 */
	public function postCreate() {

		$rules = array(
			'name'           => 'required',
			'type'           => 'required|integer|min:1'
		);

		$messages = array(
			'name.required' => 'Bạn chưa nhập tên danh mục',
			'type.min'      => 'Bạn chưa chọn loại danh mục'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$category                 = new Category;
		$category->type           = Input::get('type');
		$category->parents        = Input::get('parents');
		$category->name           = Input::get('name');
		$category->description    = Input::get('description');
		$category->cat_background = Input::get('cat_background');
		$category->active			  = Category::ACTIVE;

		$image         = new Image();
		$configuration = Config::get('configuration');
		$arrayResize   = $configuration['array_cate_icon'];
		$resultUpload  = $image->upload('cat_icon', PATH_CATEGORY_ICON, $arrayResize);

		if ($resultUpload['status'] > 0) {
         $category->cat_icon = $resultUpload['filename'];
      }

		if ($category->parents > 0) {
			$category->has_parent = 1;
		}

		if ($category->save()) {
			// Đánh dấu has_child cho cat_parent
			//
			if ($category->parents > 0 && $parents = Category::find($category->parents)) {
				$parents->has_child = 1;
				$parents->save();
			}
			return Redirect::to('/admin/categories/create')->with('success', 'Thêm danh mục thành công.');
		}

		return Redirect::to('/admin/categories')->with('error', 'Không thêm mới được danh mục');
	}

	/**
	 * Edit a category
	 */
	public function getEdit($category_id = null) {

		if (!$category = $this->mCategory->getById($category_id)) {
			return Redirect::to("admin/categories")->with('error', 'Không tìm thấy bản ghi');
		}

		$types = $this->category_types;
		$categories = $this->mCategory->getListChilds();

		unset($categories[$category_id]);

		return View::make('backend/categories/edit', compact('category', 'types', 'categories'));
	}

	/**
	 * Update a category
	 */
	public function postEdit($category_id = null) {

		if (!$category = $this->mCategory->getById($category_id)) {
			return Redirect::to("admin/categories/")->with('error', 'Không tìm thấy bản ghi');
		}

		// Validate
		//
		$rules = array(
			'name'    => 'required',
			'type'    => 'required|integer|min:1'
		);

		$messages = array(
			'name.required' => 'Bạn chưa nhập tên danh mục',
			'type.min'      => 'Bạn chưa chọn loại danh mục'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$category->type        = Input::get('type');
		$category->parents     = Input::get('parents');
		$category->name        = Input::get('name');
		$category->description = Input::get('description');
		$category->cat_background = Input::get('cat_background');

		$image = new Image();
		$configuration = Config::get('configuration');
		$arrayResize   = $configuration['array_cate_icon'];
		$resultUpload  = $image->upload('cat_icon', PATH_CATEGORY_ICON, $arrayResize);

		if ($resultUpload['status'] > 0) {
         $category->cat_icon = $resultUpload['filename'];
      }

		if ($category->parents > 0) {
			$category->has_parent = 1;
		}

		if ($category->save()) {
			// Đánh dấu has_child cho cat_parent
			//
			if ($category->parents > 0 && $parents = Category::find($category->parents)) {
				$parents->has_child = 1;
				$parents->save();
			}
			return Redirect::to("/admin/categories/{$category_id}/edit")->with('success', 'Cập nhật danh mục thành công.');
		}

		return Redirect::to('/admin/categories')->with('error', 'Không cập nhật được danh mục');
	}

	public function getDelete($category_id = null) {

		if (!$category = $this->mCategory->getById($category_id)) {
			return Redirect::back()->with('error', 'Không tìm thấy bản ghi');
		}

		$category->delete();

		return Redirect::back()->with('success', 'Xóa danh mục thành công');
	}

	/**
	 * Active category
	 */
	public function getActive($category_id = null) {
		$json = array(
			'code' => 0,
			'messages' => 'Có lỗi xảy ra, vui lòng thử lại'
		);

		if (!$category = $this->mCategory->getById($category_id)) {
			$json['messages'] = 'Không tìm thấy bản ghi';
			return Response::json($json);
		}

		$category->active = !$category->active;

		if ($category->save()) {
			$json['status']	= $category->active;
			$json['code']		= 1;
			$json['messages']	= 'Cập nhật thành công';
			return Response::json($json);
		}

		$json['messages'] = 'Active / Deactive không thành công.';

		return Response::json($json);
	}
}