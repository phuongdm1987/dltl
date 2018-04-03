<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditBookingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bookings', function(Blueprint $table)
		{
			$table->integer('boo_tour_id')->after('boo_id');
         $table->integer('boo_time_departure')->after('boo_update_time');
         $table->integer('boo_quantity')->after('boo_time_departure');
         $table->double('boo_tour_price')->after('boo_quantity');
         $table->integer('boo_user_id')->after('boo_money');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bookings', function(Blueprint $table)
		{
			//
		});
	}

}
