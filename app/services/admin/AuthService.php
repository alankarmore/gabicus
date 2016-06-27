<?php

namespace App\Services\Admin;

use Auth;
use Hash;
use Validator;
use App\Models\User;

class AuthService
{

    public function __construct()
    {
        ;
    }

    public function register($data)
    {
        try {
            $user = new User();
            $user->email = trim($data['email']);
            $user->first_name = trim($data['first_name']);
            $user->last_name = trim($data['last_name']);
            $user->password = Hash::make(trim($data['password']));
            $user->created_at = date("Y-m-d H:i:s");

            return $user->save();
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
            $rules = array(
                'first_name' => 'required|max:150',
                'last_name' => 'required|max:150',
                'email' => 'required|email|max:150|unique:users,email',
                'password' => 'required'
            );
            
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