<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id');
			$table->boolean('is_popular')->default(0);
			$table->string('title', 200);
			$table->string('slug');
			$table->text('description', 65535);
			$table->string('image_name');
			$table->string('location');
			$table->float('fees', 10, 0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
