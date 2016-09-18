<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachWithUsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teach_with_us', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('email');
			$table->string('qualification');
			$table->integer('age')->default(1);
			$table->text('message', 65535)->nullable();
			$table->string('location');
			$table->string('contact_number', 25);
			$table->text('itexperience', 65535);
			$table->text('training_courses', 65535);
			$table->string('resume');
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
		Schema::drop('teach_with_us');
	}

}
