<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCorporateTrainingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corporate_training', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('email');
			$table->integer('team_members')->default(1);
			$table->string('location');
			$table->string('contact_number', 25);
			$table->text('courses_required', 65535);
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
		Schema::drop('corporate_training');
	}

}
