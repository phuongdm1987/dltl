<?php namespace Fsd\Users;
use McCool\LaravelAutoPresenter\PresenterInterface;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Fsd\Core\Entity;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Entity implements PresenterInterface, UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

   const ACTIVE   = 1;
   const DEACTIVE = 0;

	protected $dates = ['deleted_at'];

	protected $fillable = ['email', 'domain', 'password', 'phone'];

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullName()
	{
		return "{$this->fullname}";
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPictureAvatar() {
		return $this->avatar != null ? PATH_USER_AVATAR . $this->avatar : '/assets/img/user-default.jpg';
	}

	public function getUrlUser() {
		return route('tour.by.user', [$this->id, removeTitle($this->fullname)]);
	}
	/**
	 * Relationship with city
	 */
	public function city() {
		return $this->belongsTo('City', 'city_id');
	}

	public function post() {
		return $this->hasMany('Post');
	}

	public function domains() {
		return $this->belongsToMany('Fsd\Domains\Domain', 'domains_users', 'dus_user_id', 'dus_domain_id');
	}

	public function getAvatar($type = 'sm_')
	{
		return PATH_USER_AVATAR . $type . $this->avatar;
	}


	/**
	 * Url to home page of user
	 * @return string
	 */
	public function getUrl() {
		return ;
	}


	/**
	 * Count all post
	 * @return [type] [description]
	 */
	public function countPosts() {
		return $this->post->count();
	}


   public function hasStorePrimary() {
      $store = App::make('Fsd\Stores\StoreRepository');
//      return $store->where()
   }

   public function isActivated()
   {
   	return $this->activated;
   }


   public function getPermissions() {
   	$userRepo = \App::make('Fsd\Users\UserRepository');
   	$dbPermissions = $userRepo->getAdminPermissionsByUserId($this->id);

   	$permissions = [];
   	if($dbPermissions) {
   		$permissions = json_decode($dbPermissions->ape_permissions, true);
   	}

   	return $permissions;
   }

   public function tour() {
		return $this->hasMany('Tour');
	}

	public function getPresenter() {
		return 'Fsd\Users\UserPresenter';
	}
}
