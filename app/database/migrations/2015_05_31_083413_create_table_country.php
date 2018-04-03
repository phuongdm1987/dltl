<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCountry extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('places', function($table) {
			$table->increments('pla_id');
			$table->string('pla_name', 50);
			$table->string('pla_image');
			$table->string('pla_description', 500);
			$table->text('pla_content');
			$table->float('pla_latitude');
			$table->float('pla_longitude');
			$table->integer('pla_city_id')->default(0);
			$table->integer('pla_district_id')->default(0);
			$table->tinyInteger('pla_type');
			$table->boolean('pla_active')->default(1);
			$table->integer('pla_created_at');
			$table->integer('pla_updated_at');
		});

		Schema::create('place_images', function($table) {
			$table->bigIncrements('pim_id');
			$table->bigInteger('pim_pla_id');
			$table->string('pim_image', 255);
		});

		Schema::create('countries', function($table) {
			$table->bigIncrements('cou_id');
			$table->string('cou_code', 50);
			$table->string('cou_name' ,50);
			$table->boolean('cou_hot')->default(0);
			$table->boolean('cou_default')->default(0);
			$table->boolean('cou_active')->default(1);
		});

		Schema::create('category_places', function($table) {
			$table->increments('ctp_id');
			$table->string('ctp_name', 255);
			$table->string('ctp_teaser', 255);
			$table->boolean('ctp_status')->default(1);
		});

		Schema::create('tours', function($table) {
			$table->bigIncrements('tou_id');
			$table->double('tou_price');
			$table->string('tou_name', 255);
			$table->string('tou_image', 255);
			$table->string('tou_teaser', 255);
			$table->string('tou_vehicle', 255);
			$table->integer('tou_user_id');
			$table->tinyInteger('tou_day');
			$table->tinyInteger('tou_night');
			$table->integer('tou_start_time');
			$table->integer('tou_end_time');
			$table->tinyInteger('tou_start_type');
			$table->tinyInteger('tou_type');
			$table->string('tou_tags', 255);
			$table->integer('tou_country_departure');
			$table->integer('tou_city_departure');
			$table->integer('tou_country_destination');
			$table->integer('tou_city_destination');
			$table->string('tou_place_destination', 255);
			$table->integer('tou_day_month')->default(1);
			$table->string('tou_by_week', 255);
			$table->integer('tou_created_time');
			$table->integer('tou_updated_time');
			$table->boolean('tou_status')->default(0);
		});

		Schema::create('tags', function($table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('slug', 255);
			$table->integer('words');
			$table->timestamps();
		});

		Schema::create('tour_tags', function($table) {
			$table->increments('id');
			$table->integer('tour_id');
			$table->integer('tag_id');
		});

		Schema::create('tour_contents', function($table) {
			$table->integer('tco_tour_id');
			$table->text('tco_tour_schedule');
			$table->text('tco_tour_comprise');
			$table->text('tco_tour_policies');
		});

		Schema::create('tour_images', function($table) {
			$table->increments('tim_id');
			$table->integer('tim_tour_id');
			$table->string('tim_tour_image', 255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('places');
		Schema::drop('place_images');
		Schema::drop('countries');
		Schema::drop('category_places');
		Schema::drop('tours');
		Schema::drop('tags');
		Schema::drop('tour_tags');
		Schema::drop('tour_contents');
		Schema::drop('tour_images');
	}

}
