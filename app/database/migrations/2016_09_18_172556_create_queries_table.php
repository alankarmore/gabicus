<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('email');
			$table->string('contact_number');
			$table->text('message', 65535);
			$table->boolean('training_for');
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
		Schema::drop('queries');
	}

}
