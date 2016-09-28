<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFkTableStudents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			$table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade');
			$table->foreign('education_degree_id')->references('id')->on('education_degrees')->onDelete('cascade');
			$table->foreign('education_course_type_id')->references('id')->on('education_course_types')->onDelete('cascade');
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
			$table->dropForeign('students_college_id_foreign');
			$table->dropForeign('students_education_degree_id_foreign');
			$table->dropForeign('students_education_course_type_id_foreign');
		});
	}

}
