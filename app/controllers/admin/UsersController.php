<?php namespace Controllers\Admin;

use AdminController;
use Config;
use Input;
use Lang;
use Redirect;
use Validator;
use View;
use App;
use Response;
use Fox;
use Login;
use Fsd\Users\UserRepository as UserRepository;

class UsersController extends AdminController {

	protected $userRepository;

	public function __construct(UserRepository $userRepository, Login $login) {
		parent::__construct();
		$this->userRepository = $userRepository;
		$this->login = $login;
	}

	protected $permission_prefix = 'users';

	/**
	 * Declare the rules for the form validation
	 *
	 * @var array
	 */
	protected $validationRules = array(
		'fullname'        => 'required|min:3',
		'email'            => 'required|email|unique:users,email',
		'password'         => 'required|between:3,32',
		'password_confirm' => 'required|between:3,32|same:password',
	);

	/**
	 * Show a list of all the users.
	 *
	 * @return View
	 */
	public function getIndex() {

		// Grab all the users
		$users = $this->userRepository->getModel()->whereRaw(1);

		// Filter
		$id       = Input::get('id');
		$fullname = Input::get('fullname');
		$email    = Input::get('email');

		if($id > 0) {
			$users->where('id', $id);
		}

		if($fullname) {
			$users->where('full_name', 'LIKE', '%'. $fullname .'%');
		}

		if($email) {
			$users->where('email', $email);
		}

		// Paginate the users
		$users = $users->paginate(20)
			->appends(array(
				'withTrashed' => Input::get('withTrashed'),
				'onlyTrashed' => Input::get('onlyTrashed'),
			));

		// Show the page
		return View::make('backend/users/index', compact('users'));
	}

	/**
	 * User create.
	 *
	 * @return View
	 */
	public function getCreate() {

		// Get all the available permissions
		$permissions = Config::get('permissions');
		// Show the page
		return View::make('backend/users/create', compact('permissions', 'selectedPermissions'));
	}

	/**
	 * User create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate() {

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $this->validationRules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// We need to reverse the UI specific logic for our
		// permissions here before we create the user.
		$permissions = Input::get('permissions', getAllAdminPermissionsUnCheck());

		// Get the inputs, with some exceptions
		$inputs = Input::except('_token', 'password_confirm', 'groups', 'permissions');
		$inputs['password'] = \Hash::make(Input::get('password'));

		// Was the user created?
		$user = $this->userRepository->getNew($inputs);

		if ($user = $this->userRepository->save($user))
		{
			$this->userRepository->setAdminPermissions($user->id, $permissions);

			// Prepare the success message
			$success = Lang::get('admin/users/message.success.create');

			// Redirect to the new user page
			return Redirect::route('update/user', $user->id)->with('success', $success);
		}

		// Prepare the error message
		$error = Lang::get('admin/users/message.error.create');

		// Redirect to the user creation page
		return Redirect::route('create/user')->with('error', $error);


		// Redirect to the user creation page
		return Redirect::route('create/user')->withInput()->with('error', $error);
	}

	/**
	 * User update.
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getEdit($id = null) {

		// Get the user information
		if(!$user = $this->userRepository->getById($id)) {
			return Redirect::route('users')->with('error', 'Không tìm thấy bản ghi phù hợp');
		}

		// Get this user permissions
		$userPermissions = $user->getPermissions();

		// Get all the available permissions
		$permissions = Config::get('permissions');

		// Show the page
		return View::make('backend/users/edit', compact('user', 'permissions', 'userPermissions'));
	}

	/**
	 * User update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null) {

		// We need to reverse the UI specific logic for our
		// permissions here before we update the user.
		$permissions = Input::get('permissions', array());

		if(!$user = $this->userRepository->getById($id)) {
			return $this->findNotFound();
		}

		//
		$this->validationRules['email'] = "required|email|unique:users,email,{$user->email},email";

		// Do we want to update the user password?
		if ( ! $password = Input::get('password'))
		{
			unset($this->validationRules['password']);
			unset($this->validationRules['password_confirm']);
		}

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $this->validationRules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the user
		$user->fullname  = Input::get('fullname');
		$user->email     = Input::get('email');
		$user->activated = Input::get('activated', $user->activated);


		// Do we want to update the user password?
		if ($password)
		{
			$user->password = \Hash::make($password);
		}

		// Was the user updated?
		if ($user->save())
		{

			// Set permissions
			$this->userRepository->setAdminPermissions($user->id, $permissions);

			// Prepare the success message
			$success = Lang::get('admin/users/message.success.update');

			// Redirect to the user page
			return Redirect::route('update/user', $id)->with('success', $success);
		}

		// Prepare the error message
		$error = Lang::get('admin/users/message.error.update');

		// Redirect to the user page
		return Redirect::route('update/user', $id)->withInput()->with('error', $error);
	}

	/**
	 * Delete the given user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getDelete($id = null) {
		// Check permission
		//
		if (!Fox::can($this->permission_prefix . '.delete')) {
			return App::abort('403');
		}

		try
		{
			// Get user information
			$user = $this->userRepository->getById($id);

			// Check if we are not trying to delete ourselves
			if ($user->id === $this->login->getId())
			{
				// Prepare the error message
				$error = Lang::get('admin/users/message.error.delete');

				// Redirect to the user management page
				return Redirect::route('users')->with('error', $error);
			}

			// Delete the user
			$user->delete();

			// Prepare the success message
			$success = Lang::get('admin/users/message.success.delete');

			// Redirect to the user management page
			return Redirect::route('users')->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id' ));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}
	}

	/**
	 * Restore a deleted user.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getRestore($id = null)
	{
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->createModel()->withTrashed()->find($id);

			// Restore the user
			$user->restore();

			// Prepare the success message
			$success = Lang::get('admin/users/message.success.restored');

			// Redirect to the user management page
			return Redirect::route('users')->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id'));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}
	}

	/**
	 * Active user
	 */
	public function getActive($id = null) {
		$json = array(
			'code' => 0,
			'message' => 'Có lỗi xảy ra, vui lòng thử lại'
		);

		// Check permission
		//
		if (!Fox::can($this->permission_prefix . '.edit')) {
			$json['message'] = 'Bạn không có quyền thực hiện tính năng này.';
			return Response::json($json);
		}

		if (!$user = $this->userRepository->getById($id)) {
         $json['message'] = 'Không tìm thấy tài khoản.';
         return Response::json($json);
      }

      $user->activated = !$user->activated;

      if ($user->save()) {
			$json['code']		= 1;
			$json['status']	= $user->activated;
			$json['message']	= 'Cập nhật thành công';

         return Response::json($json);
      }else{
      	$json['message'] = 'Active / Deactive không thành công.';
      }

      return Response::json($json);
	}


	/**
	 * Fake login
	 *
	 * @param  integer $id
	 *
	 * @return mixed
	 */
	public function getFakeLogin($id) {

		if( !$user = $this->userRepository->getById($id) ) {
			return Redirect::back()->with('error', 'Không tìm thấy user này');
		}

		// Log the user in
		\Auth::login($user, true);

		return Redirect::to('http://' . $_SERVER['HTTP_HOST']);

	}


	public function findNotFound()
	{
		// Prepare the error message
		$error = Lang::get('admin/users/message.user_not_found', compact('id'));

		// Redirect to the user management page
		return Redirect::route('users')->with('error', $error);
	}
}
