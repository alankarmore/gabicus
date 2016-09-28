<?php
use App\Models\Month;
use Carbon\Carbon;
class MonthTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'january','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'february','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'march','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'april','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'may','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'june','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'july','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'august','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'september','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'october','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'november','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'december','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		Month::insert($data);
	}

}
