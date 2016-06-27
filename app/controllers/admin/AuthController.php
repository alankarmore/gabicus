<?php

namespace App\Controllers\Admin;

use Auth;
use View;
use Input;
use Redirect;
use App\Services\Admin\AuthService;

class AuthController extends \BaseController
{

    public function __construct()
    {
        $this->service = new AuthService();
    }

    /**
     * Display registraion form.
     *
     * @return Response
     */
    public function register()
    {
        try {
            return View::make('admin.auth.register');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function postRegister()
    {
        try {
            $inputData = Input::all();
            $validation = $this->service->validate($inputData);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            
            $registered = $this->service->register($inputData);
            if ($registered) {
                return Redirect::to('admin/sign-in');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while registration');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function login()
    {
        return View::make('admin.auth.login');
    }
    
    public function postLogin()
    {
        try {
            $inputData = Input::all();
            $validation = $this->service->validate($inputData,'login');
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            
            $loginResponse = $this->service->login($inputData);
            if ($loginResponse) {
                return Redirect::route('admin.categories');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while login in system');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function logout()
    {
        try {
            Auth::logout();
            
            return Redirect::to('admin/sign-in');
        } catch (\Exception $ex) {
            echo $ex->getMessage();die;
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}