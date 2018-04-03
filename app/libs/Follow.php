<?php

/**
 * Class quản lý việc theo dõi, bỏ theo dõi của người dùng
 * @author  Cong Luong <cong.itsoft@gmail.com>
 * @version 1.0
 * Date : 20/10/2013
 * Last Edit : 28/04/2014
 *
 * # Theo dõi 1 user
 * $follow->setFollow(1,2);
 *
 * # Bỏ theo dõi 1 user
 * $follow->setUnFollow(1,2);
 *
 * # Kiểm tra xem dõi theo chưa
 * $follow->checkFollow(1, 2)
 *
 * # Lấy ra danh sách người mình đang dõi theo
 * $follow->getListFollowing(1);
 *
 * # Lấy ra danh sách người đang theo dõi mình
 * $follow->getListFollower(1);
 */
class Follow {

	/**
	 * Số lượng bảng
	 */
	const NUM_TABLE_FOLLOW = 1000;

	protected $login ;

	public function __construct() {
		$this->login = App::make('login');
	}

	/**
	 * Set mối quan hệ user theo dõi friend
	 * @param integer $userId   [description]
	 * @param integer $friendId [description]
	 * @return  bool
	 */
	public function setFollow($userId, $friendId) {
		//Bảng lưu thông tin các bạn mà user đã follow
		$tableUserFollowFriend = $this->generateTableUserFollowFriend($userId);

		//Bảng lưu thông tin các bạn đã follow người này
		$tableFriendFollowUser = $this->generateTableFriendFollowUser($friendId);

		//Chưa có bảng thì tạo bảng
		if(!$this->checkTableExist($tableUserFollowFriend)) {
			$this->createTableUserFollowFriend($tableUserFollowFriend);
		}

		if(!$this->checkTableExist($tableFriendFollowUser)) {
			$this->createTableFriendFollowUser($tableFriendFollowUser);
		}

		//Không thể tự follow chính mình
		if($userId == $friendId) {
			return false;
		}

		//Bắt đầu set quan hệ
		$folTime = time();
		$sql = "INSERT IGNORE INTO $tableUserFollowFriend(fol_user_id, fol_friend_id, fol_time)
				  VALUES($userId, $friendId, $folTime)";

		$arrayBindingsUser = array(
			':fol_user_id' 		=> $userId,
			':fol_friend_id' 		=> $friendId,
			':fol_time' 			=> $folTime
		);

		$arrayBindingsFriend = array(
			':fol_friend_id' => $userId,
			':fol_user_id'   => $friendId,
			':fol_time'      => $folTime
		);

		if(
			DB::statement("INSERT IGNORE INTO $tableUserFollowFriend(fol_user_id, fol_friend_id, fol_time) VALUES(:fol_user_id, :fol_friend_id, :fol_time)", $arrayBindingsUser)
			&& DB::statement("INSERT IGNORE INTO $tableFriendFollowUser(fol_friend_id, fol_user_id, fol_time) VALUES(:fol_friend_id, :fol_user_id, :fol_time)", $arrayBindingsFriend)
		){
			return true;
		}

		return false;

	}



	/**
	 * Bỏ dõi theo
	 * @param  integer $userId   [description]
	 * @param  integer $friendId [description]
	 * @return bool           [description]
	 */
	public function setUnFollow($userId, $friendId) {

		if($userId == $friendId) {
			return false;
		}
		//Bảng lưu thông tin các bạn mà user đã follow
		$tableUserFollowFriend = $this->generateTableUserFollowFriend($userId);

		//Bảng lưu thông tin các bạn đã follow người này
		$tableFriendFollowUser = $this->generateTableFriendFollowUser($friendId);

		//Bắt đầu bỏ quan hệ
		//
		$arrayBindingsUser = array(
			':fol_user_id' 	=> $userId,
			':fol_friend_id' 	=> $friendId
		);

		$arrayBindingsFriend = array(
			':fol_user_id' 	=> $friendId,
			':fol_friend_id' 	=> $userId
		);

		if(
			DB::statement("DELETE FROM $tableUserFollowFriend WHERE fol_user_id = :fol_user_id AND fol_friend_id = :fol_friend_id", $arrayBindingsUser)
			&& DB::statement("DELETE FROM $tableFriendFollowUser WHERE fol_user_id = :fol_user_id AND fol_friend_id = :fol_friend_id", $arrayBindingsFriend)
		){
			return true;
		}

		return false;
	}


	/**
	 * Kiểm tra user đã follow friend chưa
	 * @param  integer $userId   [description]
	 * @param  integer $friendId [description]
	 * @return bool         [description]
	 */
	public function checkFollow($userId, $friendId) {
		//Bảng lưu thông tin các bạn mà user đã follow
		$tableUserFollowFriend = $this->generateTableUserFollowFriend($userId);

		if(!$this->checkTableExist($tableUserFollowFriend)) {
			return false;
		}

		$arrayBindings = array(
			':fol_user_id' 	=> $userId,
			':fol_friend_id' 	=> $friendId
		);

		$count = DB::select("SELECT count(*) as count FROM $tableUserFollowFriend WHERE fol_user_id = :fol_user_id AND fol_friend_id = :fol_friend_id", $arrayBindings);

		if(isset($count[0]) && $count[0]->count > 0) {
			return true;
		}

		return false;
	}

	/**
	 * Lấy ra danh sách người đang theo dõi mình
	 * @param  integer $userId
	 * @param  integer $start
	 * @param  integer $limit
	 * @param  bool $isLimit  Có limit không?
	 * @return mix
	 */
	public function getListFollower($userId, $start = 0, $limit = 20, $isLimit = true) {
		//Bảng lưu thông tin các bạn đã follow người này
		$tableFriendFollowUser = $this->generateTableFriendFollowUser($userId);

		if(!$this->checkTableExist($tableFriendFollowUser)) return array();

		$start = (int) $start;
		$limit = (int) $limit;

		$sqlLimit = " LIMIT $start, $limit";

		if(!$limit) {
			$sqlLimit = '';
		}

		$list = DB::select("SELECT * FROM $tableFriendFollowUser WHERE fol_user_id = :fol_user_id ORDER BY fol_time DESC $sqlLimit", array(':fol_user_id' => $userId));
		$data = array();
		foreach($list as $row) {
			$data[] = $row->fol_friend_id;
		}

		return $data;
	}


	/**
	 * Đếm số lượng user mà người này đang theo dõi
	 * @param  [type] $userId [description]
	 * @return [type]         [description]
	 */
	public function countFollowing($userId) {
		//Bảng lưu thông tin các bạn mà user đã follow
		$tableUserFollowFriend = $this->generateTableUserFollowFriend($userId);

		// Không tồn tại bảng thì return array
		if(!$this->checkTableExist($tableUserFollowFriend)) return 0;

		$list = DB::select("SELECT count(*) as count FROM $tableUserFollowFriend WHERE fol_user_id = :fol_user_id ORDER BY fol_time DESC", array(':fol_user_id' => $userId));

		return isset($list[0]->count) ? $list[0]->count : 0;
	}


	/**
	 * Đếm số lượng user đang theo dõi người này
	 * @param  [type] $userId [description]
	 * @return [type]         [description]
	 */
	public function countFollower($userId) {
		//Bảng lưu thông tin các bạn đã follow người này
		$tableFriendFollowUser = $this->generateTableFriendFollowUser($userId);

		if(!$this->checkTableExist($tableFriendFollowUser)) return 0;

		$list = DB::select("SELECT count(*) as count FROM $tableFriendFollowUser WHERE fol_user_id = :fol_user_id ORDER BY fol_time DESC", array(':fol_user_id' => $userId));

		return isset($list[0]->count) ? $list[0]->count : 0;
	}


	/**
	 * Lấy ra những người mà user này đang theo dõi
	 * @param  integer $userId
	 * @return mix
	 */
	public function getListFollowing($userId, $start = 0, $limit = 25) {

		//Bảng lưu thông tin các bạn mà user đã follow
		$tableUserFollowFriend = $this->generateTableUserFollowFriend($userId);

		// Không tồn tại bảng thì return array
		if(!$this->checkTableExist($tableUserFollowFriend)) return array();

		$start = (int) $start;
		$limit = (int) $limit;

		$list = DB::select("SELECT * FROM $tableUserFollowFriend WHERE fol_user_id = :fol_user_id ORDER BY fol_time DESC LIMIT $start, $limit", array(':fol_user_id' => $userId));
		$data = array();
		foreach($list as $row) {
			$data[] = $row->fol_friend_id;
		}

		return $data;
	}


	/**
	 * Tạo nút theo dõi
	 * @param  integer $userId userId cần theo dõi
	 * @return html
	 */
	public function createButtonFollow($userId, $classExtenal = "") {

		$dataStatus = 'notfollow';
		$class      = 'follow';
		$text       = 'Theo dõi';

		$loggedId = $this->login->getId();

		if($this->checkFollow($loggedId, $userId)) {
			$dataStatus = 'follow';
			$class      = 'unfollow';
			$text       = 'Đang theo dõi';
		}
		$html = '<div id="btn-follow-friend" data-followstatus="'.$dataStatus.'" data-token="'. csrf_token() .'" data-urlreturn="'.base64_encode($_SERVER['REQUEST_URI']).'" data-uid="'.$userId.'" class="line-info btn-follow-cc '.$class . ' ' . $classExtenal .'">'.$text.'</div>';
		return $html;
	}


	/**
	 * Tạo bảng lưu các bạn mà user dõi theo
	 * @param  [type] $tablename [description]
	 * @return [type]            [description]
	 */
	public function createTableUserFollowFriend($tablename) {
		$sql = "CREATE TABLE $tablename(
			fol_user_id int(11),
			fol_friend_id int(11),
			fol_time int(11),
			PRIMARY KEY(fol_user_id, fol_friend_id)
		)";


		if(DB::statement($sql)) {
			return true;
		}

		return false;
	}

	/**
	 * Tạo bảng lưu các bạn dõi theo 1 user
	 * @param  [type] $tablename [description]
	 * @return [type]            [description]
	 */
	public function createTableFriendFollowUser($tablename) {
		$sql = "CREATE TABLE $tablename(
			fol_friend_id int(11),
			fol_user_id int(11),
			fol_time int(11),
			PRIMARY KEY(fol_user_id, fol_friend_id)
		)";

		if(DB::statement($sql)) {
			return true;
		}

		return false;
	}



	/**
	 * Trả về tên bảng những người user đã dõi theo
	 * @param  integer $userId [description]
	 * @return string         [description]
	 */
	public function generateTableUserFollowFriend($userId) {
		$tablename = 'follow_user_friend_' . $userId % self::NUM_TABLE_FOLLOW;
		return $tablename;
	}


	/**
	 * Trả về tên bảng những người dõi theo user này
	 * @param  integer $userId [description]
	 * @return string         [description]
	 */
	public function generateTableFriendFollowUser($userId) {
		$tablename = 'follow_friend_user_' . $userId % self::NUM_TABLE_FOLLOW;
		return $tablename;
	}


	/**
	 * Kiem tra bang da co chua
	 * @param  [type] $tablename [description]
	 * @return [type]            [description]
	 */
	public function checkTableExist($tablename) {

		if(DB::select("SHOW TABLES LIKE '". $tablename ."'")) {
			return true;
		}

		return false;
	}
}