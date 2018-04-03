<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscribers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscribers', function($table) {
			$table->increments('sub_id');
			$table->string('sub_email', 255);
			$table->integer('sub_time_created');
			$table->integer('sub_time_updated');
			$table->boolean('sub_active')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
