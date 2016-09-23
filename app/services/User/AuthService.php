<?php

namespace App\Services\User;

use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\User;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Role;
use App\Models\UserRoleAssociation;


class AuthService
{

    public function register($data)
    {
        try {
            $timeStamp = Carbon::now();
            $data['remember_token'] = $data['_token'].strtotime($timeStamp);
            $data['password'] = Hash::make($data['password']);
            $data['created_at'] = $timeStamp;
            $data['updated_at'] = $timeStamp;
            Mail::send('emails.user.welcome', $data, function($message) use ($data)
            {
                $message->to($data['email'], $data['first_name']." ".$data['last_name'])->subject('Welcome!');
            });
            $user = User::create($data);

            if('student'==$data['user_type']){
                $data['user_id'] = $user->id;
                Student::create($data);
            }
            if('employee'==$data['user_type']){
                $data['user_id'] = $user->id;
                Employee::create($data);
            }
            if('recruiter' == $data['user_type']){
                $role = Role::where('name','recruiter')->first();
            }else{
                $role = Role::where('name','user')->first();
            }
            $userRoleAssociationData = array(
                'user_id' => $user->id,
                'role_id' => $role->id,
                'created_at' => $timeStamp,
                'updated_at' => $timeStamp,
            );
            UserRoleAssociation::create($userRoleAssociationData);
            return true;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function login($data)
    {
        try {
            return Auth::attempt(array('email' => $data['email'],'password' => $data['password']));
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function validate($data,$for = null)
    {
        try {
            if($for==NULL){
                $rules = array(
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'email' => 'required|email|max:150|unique:users,email',
                    'password' => 'required|max:30',
                    'user_type' => 'required',
                );
            }
            if($for == 'login') {
                $rules = array(
                    'email' => 'required|email|max:150',
                    'password' => 'required'
                );                
            }

            return Validator::make($data, $rules);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}