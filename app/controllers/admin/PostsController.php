<?php namespace Controllers\Admin;

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
use Image;
use Config;
use Fsd\Posts\Post;
use Fsd\Posts\PostRepository;
use Fsd\Categories\Category;
use Fsd\Categories\CategoryRepository;

class PostsController extends AdminController {

	public function __construct(PostRepository $post, CategoryRepository $mCategory) {

		parent::__construct();
		$this->post 		= $post;
		$this->mCategory	= $mCategory;
	}

	public function getIndex() {
		$posts = $this->post->getPostByPagination(25);

		$dataGrid = new DataGrid([
			'data' => $posts,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $posts->getTotal()
			]
		]);

		$dataGrid->addColumn('pos_id', 'ID', 1);
		$dataGrid->addColumn('pos_title', 'Tiêu đề', 1);

		$dataGrid->addColumn('', 'Edit', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('post.edit', [$item->pos_id]));
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['pos_active'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/posts/active/'. $item['pos_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

		$dataGrid->addColumn('', 'hot', 0, array('width' => 30), function($item) {
			$classActive = $item['pos_hot'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/posts/hot/'. $item['pos_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

		$dataGrid->addColumn('', 'Delete', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('post.delete', [$item->pos_id]));
		});


		$data_grid = $dataGrid->render(false);

		return View::make('backend/posts/index', compact('data_grid'));
	}

	public function getEdit($id = 0) {

		if($id > 0) {
			$post = $this->post->getPostById($id);
		}else{
			$post = $this->post->getInstance();
		}

		if(!$post) return App::abort(404);

		if(Request::isMethod('post')) {
			return $this->postEdit($post);
		}

		$categories = $this->mCategory->getListChilds();

		return View::make('backend/posts/edit', compact('post', 'categories'));
	}

	public function postEdit($post) {

		$rules = array(
			'pos_title'   => 'required|min:3',
			'pos_teaser' => 'required|min:3',
			'pos_content' => 'required|min:3',
			'category_id' => 'required|integer|min:1'
		);

		 $messages = array(
			'pos_title.required'   => 'Bạn chưa nhập tiêu',
			'pos_teaser.required' => 'Mô tả ngắn không bỏ trống',
			'pos_content.required' => 'Nội dung không bỏ trống',
			'category_id.min' 	  => 'Vui lòng chọn danh mục'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules, $messages);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$post->pos_title			= Xss::clean(Input::get('pos_title'));
		$post->pos_icon			= Xss::clean(Input::get('pos_icon'));
		$post->pos_teaser		   = Xss::clean(Input::get('pos_teaser'));
		$post->pos_content		= Xss::clean(Input::get('pos_content'));
		$post->pos_category_id  = (int) Input::get('category_id');
		$post->pos_active			= Post::PUBLISHED;
		$post->pos_type			= Post::PUBLIC_SITE;
		$post->pos_create_time	= time();
		$post->pos_update_time	= time();

		$image 			= new Image();
		$configuration = Config::get('configuration');
		$arrayResize   = $configuration['array_post_thumbnail'];
		$resultUpload  = $image->upload('pos_image', PATH_UPLOAD_IMAGE_POST, $arrayResize);

		if ($resultUpload['status'] > 0) {
			$post->pos_image = $resultUpload['filename'];
		}

		if ($post->save()) {
			return Redirect::route('post.index')->with('success', 'Thêm thành công.');
		}
		return Redirect::back()->with('error', 'Không thêm mới được');
	}

	public function getActive($id) {

		$post = $this->post->getPostById($id);

		if(!$post) return Redirect::to(route('post.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$post->pos_active = !$post->pos_active;

		if ($post->save()) {
			$json['status']	= $post->pos_active;
			$json['code']		= 1;
			$json['message']	= 'Cập nhật thành công';
			return Response::json($json);
		}
		else{
			$json['message'] = 'Cập nhật không thành công';
		}

		return Response::json($json);
	}

	public function getHot($id) {

		$post = $this->post->getPostById($id);

		if(!$post) return Redirect::to(route('post.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$post->pos_hot = !$post->pos_hot;

		if ($post->save()) {
			$json['status']	= $post->pos_hot;
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
	public function getDelete($id) {
		$post = $this->post->getPostById($id);

		if(!$post) return Redirect::to(route('post.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$this->post->delete($post);

		return Redirect::to(route('post.index'))->with('success', 'Xóa thành công 1 bản ghi');
	}
}