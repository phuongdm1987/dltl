<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('users')->truncate();
		DB::table('users')->where('email', 'admin@developervn.com')->delete();

		$adminId = DB::table('users')->insertGetId([
			'email'     => 'admin@developervn.com',
			'password'  => Hash::make(123456),
			'gender'    => 1,
			'fullname'  => 'Justin Luong',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
			'activated' => 1,
			'phone'     => '841694132368'
		]);

		DB::table('admin_permissions')->where('ape_user_id', $adminId)->delete();

		DB::table('admin_permissions')->insert([
		   'ape_user_id' => $adminId,
		   'ape_permissions' => json_encode(getAllAdminPermissions())
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$admin = DB::table('users')->where('email', 'admin@developervn.com')->first();

		if($admin) {
			DB::table('admin_permissions')->where('ape_user_id', $admin->id)->delete();
		}

		DB::table('users')->where('email', 'admin@developervn.com')->delete();
	}

}
