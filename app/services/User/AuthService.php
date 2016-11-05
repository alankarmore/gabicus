<?php

namespace App\Services\User;

use App\Models\City;
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
            $token = $data['_token'];
            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->user_type = $data['user_type'];
            $user->email = $data['email'];
            $user->state_id = $data['state'];
            $user->city_id = $data['city'];
            $user->password = Hash::make($data['password']);
            $user->remember_token = $token.strtotime($timeStamp);
            $user->created_at = $timeStamp;
            $user->updated_at = $timeStamp;
            $user->save();

            unset($data['_token']);
            $data['remember_token'] = $user->remember_token;
            Mail::send('emails.user.welcome', $data, function($message) use ($data) {
                $message->to($data['email'], $data['first_name'] . " " . $data['last_name'])->subject('Welcome!');
            });

            unset($data['remember_token']);
            if ('student' == $data['user_type']) {
                $student = new Student();
                $student->user_id = $user->id;
                $student->save();
            }

            if ('employee' == $data['user_type']) {
                $employee = new Employee();
                $employee->user_id = $user->id;
                $employee->save();
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
                    'gender' => 'required',
                    //'phone_no' => 'regex:/^\d{8,12}$/',
                    //'mobile_no' => 'required|regex:/^\d{10}$/',
                    'user_type' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    //'mobile_no' => 'required|min:10:max:12',
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
                'email.unique' => 'Email address already being used',
                'password.required' => 'Set your password credentials',
                'password.max' => 'Password must be less than 30 characters',
                'user_type.required' => 'Select your profession',
                'state.required' => 'Select your state',
                'city.required' => 'Select your city',
                //'mobile_no.required' => 'Mobile number is missing',
                //'mobile_no.min' => 'Mobile number must not be less than 10 digits',
                //'mobile_no.max' => 'Mobile number must be less than 12 digits',
            );

            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Get cities by state id
     *
     * @param integer $stateId
     * @return App\City | boolean
     */
    public function getCitiesByState($stateId)
    {
        return City::getCitiesByState($stateId);
    }
}