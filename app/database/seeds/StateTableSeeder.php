<?php
use App\Models\State;

class StateTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        \DB::table('states')->truncate();
        $states = array(
            array('id' => '1','name' => 'Andaman and Nicobar Islands','slug' => 'andaman-and-nicobar-islands','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '2','name' => 'Andhra Pradesh','slug' => 'andhra-pradesh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '3','name' => 'Arunachal Pradesh','slug' => 'arunachal-pradesh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '4','name' => 'Assam','slug' => 'assam','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '5','name' => 'West Bengal','slug' => 'west-bengal','status' => '1','created_at' => NULL,'updated_at' => '2016-10-01 05:09:56','deleted_at' => NULL),
            array('id' => '6','name' => 'Bihar','slug' => 'bihar','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '7','name' => 'Chandigarh','slug' => 'chandigarh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '8','name' => 'Chhattisgarh','slug' => 'chhattisgarh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '9','name' => 'Delhi','slug' => 'delhi','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '10','name' => 'Goa','slug' => 'goa','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '11','name' => 'Gujarat','slug' => 'gujarat','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '12','name' => 'Haryana','slug' => 'haryana','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '13','name' => 'Himachal Pradesh','slug' => 'himachal-pradesh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '14','name' => 'Jammu and Kashmir','slug' => 'jammu-and-kashmir','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '15','name' => 'Jharkhand','slug' => 'jharkhand','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '16','name' => 'Karnataka','slug' => 'karnataka','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '17','name' => 'Kerala','slug' => 'kerala','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '18','name' => 'Madhya Pradesh','slug' => 'madhya-pradesh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '19','name' => 'Maharashtra','slug' => 'maharashtra','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '20','name' => 'Manipur','slug' => 'manipur','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '21','name' => 'Meghalaya','slug' => 'meghalaya','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '22','name' => 'Mizoram','slug' => 'mizoram','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '23','name' => 'Nagaland','slug' => 'nagaland','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '24','name' => 'Orissa','slug' => 'orissa','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '25','name' => 'Pondicherry','slug' => 'pondicherry','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '26','name' => 'Punjab','slug' => 'punjab','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '27','name' => 'Rajasthan','slug' => 'rajasthan','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '28','name' => 'Tamil Nadu','slug' => 'tamil-nadu','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '29','name' => 'Tripura','slug' => 'tripura','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '30','name' => 'Uttar Pradesh','slug' => 'uttar-pradesh','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '31','name' => 'Uttaranchal','slug' => 'uttaranchal','status' => '1','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL)
        );

        State::insert($states);
	}

}
