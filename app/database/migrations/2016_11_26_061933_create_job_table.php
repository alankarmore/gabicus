<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs',function(Blueprint $table){
            $table->increments('id');
            $table->integer('recruiter_id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('qualification');
            $table->text('skills')->nullable();
            $table->string('experience')->nullable();
            $table->string('location');
            $table->tinyInteger('status');
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
        Schema::drop('jobs');
	}

}
