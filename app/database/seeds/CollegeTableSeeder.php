<?php
use App\Models\College;
use Carbon\Carbon;
class CollegeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'Sinhgad College','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Mit College','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'PICT College','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		College::insert($data);
	}

}
