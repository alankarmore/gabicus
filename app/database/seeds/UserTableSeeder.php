<?php
use App\Models\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStamp = Carbon::now();
        $data = array(
            array('first_name'=>'admin',
                'last_name'=>'admin',
                'email'=>'admin@mailinator.com',
                'password'=> \Hash::make('123456'),
                'created_at'=> $timeStamp,
                'updated_at'=>$timeStamp
            ),
        );

        User::insert($data);
    }

}
