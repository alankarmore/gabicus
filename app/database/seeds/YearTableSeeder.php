<?php
use App\Models\Year;
use Carbon\Carbon;
class YearTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'2016','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'2015','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'2014','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'2013','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'2012','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'2011','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		Year::insert($data);
	}

}
