<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('company_name',255)->nullable();
			$table->string('location',255)->nullable();
			$table->string('designation',255)->nullable();
			$table->string('specialization',255)->nullable();
			$table->string('total_it_experience',255)->nullable();
			$table->string('total_experience',255)->nullable();
			$table->integer('user_id');
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
		Schema::drop('employees');
	}

}
