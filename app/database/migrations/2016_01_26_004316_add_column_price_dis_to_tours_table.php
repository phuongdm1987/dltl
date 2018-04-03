<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPriceDisToToursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tours', function(Blueprint $table)
		{
			$table->double('tou_price_pub')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tours', function(Blueprint $table)
		{
			$table->dropColumn(['tou_price_pub']);
		});
	}

}
