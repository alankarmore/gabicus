<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmsMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_menu', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('include_in')->nullable();
			$table->string('title', 150);
			$table->string('slug');
			$table->string('image');
			$table->text('description', 65535);
			$table->string('meta_title');
			$table->string('meta_keyword');
			$table->string('meta_description');
			$table->boolean('status');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cms_menu');
	}

}
