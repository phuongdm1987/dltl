<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs', function(Blueprint $table)
		{
			$table->increments('id');
         $table->string('title', 255);
         $table->text('teaser', 255);
         $table->string('image', 255);
         $table->text('content');
         $table->tinyInteger('active');
         $table->tinyInteger('hot');
         $table->integer('category_id');
         $table->integer('user_id');
         $table->string('slug', 255);
         $table->integer('view')->index()->default(0)->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blogs');
	}

}
