<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RoleTableSeeder');
		$this->call('CollegeTableSeeder');
		$this->call('CollegeTableSeeder');
		$this->call('EducationDegreeTableSeeder');
		$this->call('EducationCourseTypeTableSeeder');
		$this->call('MonthTableSeeder');
		$this->call('YearTableSeeder');
		$this->call('StateTableSeeder');

	}

}
