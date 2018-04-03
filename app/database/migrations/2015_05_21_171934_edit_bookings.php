<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditBookings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bookings', function($table) {
			$table->double('boo_money')->after('boo_update_time');
		});

		Schema::table('booking_details', function($table) {
			$table->double('bde_price');
		});

		Schema::table('bookings_user', function($table) {
			$table->double('bus_tour_price');
		});

		Schema::rename('booking_details', 'bookings_details');
		Schema::rename('bookings_user', 'bookings_users');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bookings', function($table) {
			$table->dropColumn('boo_money');
		});

		Schema::table('booking_details', function($table) {
			$table->dropColumn('bde_price');
		});

		Schema::table('bookings_user', function($table) {
			$table->dropColumn('bus_tour_price');
		});
	}

}
