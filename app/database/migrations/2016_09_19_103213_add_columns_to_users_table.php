<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('gender')->after('remember_token')->nullable();
			$table->date('birth_date')->after('gender')->nullable();
			$table->string('state',255)->after('birth_date')->nullable();
			$table->string('city',255)->after('state')->nullable();
			$table->string('phone_no',255)->after('city')->nullable();
			$table->string('mobile_no',255)->after('phone_no')->nullable();
			$table->string('user_type',255)->after('mobile_no')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('mobile_no');
			$table->dropColumn('phone_no');
			$table->dropColumn('city');
			$table->dropColumn('state');
			$table->dropColumn('birth_date');
			$table->dropColumn('gender');
			$table->dropColumn('user_type');
		});
	}

}
