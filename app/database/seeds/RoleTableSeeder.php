<?php
use App\Models\Role;
use Carbon\Carbon;
class RoleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStamp = Carbon::now();
		$data = array(
			array('name'=>'admin','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'recruiter','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
			array('name'=>'user','created_at'=>$timeStamp,'updated_at'=>$timeStamp),
		);
		Role::insert($data);
	}

}
