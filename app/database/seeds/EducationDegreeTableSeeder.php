<?php
use App\Models\EducationDegree;
use Carbon\Carbon;
class EducationDegreeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'Engineering','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Science','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Arts','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Commerce','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		EducationDegree::insert($data);
	}

}
