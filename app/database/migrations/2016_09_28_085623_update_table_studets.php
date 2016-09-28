<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableStudets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			//$table->dropColumn('education');
			$table->unsignedInteger('college_id')->after('user_id')->nullable();
			$table->unsignedInteger('education_degree_id')->after('college_id')->nullable();
			$table->unsignedInteger('education_course_type_id')->after('education_degree_id')->nullable();
			$table->string('month',255)->after('id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table)
		{
			$table->dropColumn('month');
			$table->dropColumn('college_id');
			$table->dropColumn('education_degree_id');
			$table->dropColumn('education_course_type_id');
		});
	}

}
