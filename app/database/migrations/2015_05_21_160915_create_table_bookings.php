<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBookings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function($table) {
			$table->bigIncrements('boo_id');
			$table->tinyInteger('boo_status');
			$table->integer('boo_create_time');
			$table->integer('boo_update_time');
			$table->string('boo_customer_name');
			$table->string('boo_customer_phone');
			$table->string('boo_customer_email');
			$table->string('boo_customer_address');
			$table->string('boo_customer_note');
		});

		Schema::create('booking_details', function($table) {
			$table->bigIncrements('bde_id');
			$table->bigInteger('bde_booking_id');
			$table->bigInteger('bde_tour_id');
		});

		Schema::create('bookings_user', function($table) {
			$table->bigIncrements('bus_id');
			$table->bigInteger('bus_user_id');
			$table->bigInteger('bus_tour_id');
			$table->tinyInteger('bus_status');
			$table->integer('bus_create_time');
			$table->integer('bus_update_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookings');
		Schema::drop('booking_details');
		Schema::drop('bookings_user');
	}

}
