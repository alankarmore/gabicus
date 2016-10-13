<?php
use App\Models\State;
use Carbon\Carbon;
class StateTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'Maharashtra','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Gujarat','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'M.P.','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'Keral','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		State::insert($data);
	}

}
