<?php

namespace App\Services\User;

use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\User;
use App\Models\Student;
use App\Models\Employee;


class ProfileService
{

    public function update($user)
    {
        try {
            $userData = Input::only('first_name','last_name','birth_date','state','city','phone_no','mobile_no','gender','birth_date');
            User::where('id',$user->id)->update($userData);

            if($user->user_type=='student'){
                $studentData = Input::only('college_name','education','year','location');
                Student::where('user_id',$user->id)->update($studentData);
            }
            if($user->user_type=='employee'){
                $employeeData = Input::only('company_name','designation','specialization','total_it_experience','total_experience','location');
                Employee::where('user_id',$user->id)->update($employeeData);
            }
            return true;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function passwordUpdate($user,$password)
    {
        try {
            $password = Hash::make($password);
            User::where('id',$user->id)->update(array('password'=>$password));
            return TRUE;
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function validate($data,$for = null,$type)
    {
        try {
            if($type=='profile'){
                $rules = array(
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'birth_date' => 'required',
                    'state' => 'required|max:150',
                    'city' => 'required|max:150',
                    'phone_no' => 'regex:/^\d{8,12}$/',
                    'mobile_no' => 'required|regex:/^\d{10}$/'
                );
                if($for=='student'){
                    $rules['college_name'] = 'required|max:50';
                    $rules['education'] = 'required|max:50';
                    $rules['year'] = 'required|integer|max:4';
                    $rules['location'] = 'required|max:50';
                }
                if($for=='employee'){
                    $rules['company_name'] = 'required|max:50';
                    $rules['designation'] = 'required|max:50';
                    $rules['specialization'] = 'required|max:20';
                    $rules['total_it_experience'] = 'required|integer|max:2';
                    $rules['total_experience'] = 'required|integer|max:2';
                    $rules['location'] = 'required|max:50';
                }
            }elseif($type=='password'){
                $rules = array(
                    'current_password' => 'required|max:30',
                    'password' => 'required|confirmed|max:30',
                );
            }
            $messages = array(
                'phone_no.regex' => 'Phone number should be number and in between 8 to 12 digits',
                'mobile_no.regex' => 'Mobile number should be number and it should be 10 digits',
            );
            return Validator::make($data, $rules,$messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}