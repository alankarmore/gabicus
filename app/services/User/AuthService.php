<?php

namespace App\Services\User;

use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\Student;
use App\Models\Employee;
use App\Models\UserRoleAssociation;

class AuthService
{

    public function getStates()
    {
        return State::where('status','=',\DB::raw(1))->orderBy('name','ASC')->get();
    }
    
    public function register($data)
    {
        try {
            $timeStamp = Carbon::now();
            $data['remember_token'] = $data['_token'] . strtotime($timeStamp);
            $data['password'] = Hash::make($data['password']);
            $data['created_at'] = $timeStamp;
            $data['updated_at'] = $timeStamp;
            Mail::send('emails.user.welcome', $data, function($message) use ($data) {
                $message->to($data['email'], $data['first_name'] . " " . $data['last_name'])->subject('Welcome!');
            });
            $user = User::create($data);

            if ('student' == $data['user_type']) {
                $data['user_id'] = $user->id;
                Student::create($data);
            }
            if ('employee' == $data['user_type']) {
                $data['user_id'] = $user->id;
                Employee::create($data);
            }
            if ('recruiter' == $data['user_type']) {
                $role = Role::where('name', 'recruiter')->first();
            } else {
                $role = Role::where('name', 'user')->first();
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
            return Auth::attempt(array('email' => $data['email'], 'password' => $data['password']));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function validate($data, $for = null)
    {
        try {
            if ($for == NULL) {
                $rules = array(
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email',
                    'password' => 'required|max:30',
                    'user_type' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'mobile_no' => 'required|min:10:max:12',
                );
            }
            if ($for == 'login') {
                $rules = array(
                    'email' => 'required|email|max:255',
                    'password' => 'required'
                );
            }

            $messages = array(
                'first_name.required' => 'First name is missing',
                'first_name.max' => 'First name must be less than 255 characters',
                'last_name.required' => 'Last name is missing',
                'last_name.max' => 'Last name must be less than 255 characters',
                'email.required' => 'Email address is missing',
                'email.email' => 'Enter valid email address',
                'email.max' => 'Email must be less than 255 characters',
                'email.unique' => 'Email adrress already being used',
                'password.required' => 'Password is missing',
                'password.max' => 'Password must be less than 30 characters',
                'user_type.required' => 'Select your profession',
                'state.required' => 'Select your state',
                'city.required' => 'Select your city',
                'mobile_no.required' => 'Mobile number is missing',
                'mobile_no.min' => 'Mobile number must not be less than 10 digits',
                'mobile_no.max' => 'Mobile number must be less than 12 digits',
            );

            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}