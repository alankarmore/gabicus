<?php
use App\Models\EducationCourseType;
use Carbon\Carbon;
class EducationCourseTypeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'IT','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Computer Science','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Accounts','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Management','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		EducationCourseType::insert($data);
	}

}
