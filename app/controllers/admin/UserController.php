<?php

namespace App\Controllers\Admin;

use Input;
use Session;
use View;
use Redirect;
use App\Services\Admin\UserService;

class UserController extends \BaseController
{

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.user.index');
    }

    /**
     * get all menus
     * 
     * @return json
     */
    public function getData()
    {
        return $this->service->getRecords();
    }    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $inputData = Input::all();
        $validation = $this->service->validate($inputData);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }

        $user = $this->service->saveOrUpdateDetails($inputData);
        if ($user) {
            Session::flash('success_message', 'User has been saved successfully!');

            return Redirect::route('admin.user.edit', ['id' => $user->id]);
        }

        return Redirect::back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty($id)) {
            $userDetails = $this->service->getDetailsById($id);
           
            return View::make('admin.user.show', ['user' => $userDetails]);
        }

        return Redirect::route('admin.user.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $userDetails = $this->service->getDetailsById($id);

            return View::make('admin.user.edit', ['user' => $userDetails]);
        }

        return Redirect::route('admin.user.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $inputData = Input::all();
        $validation = $this->service->validate($inputData,$id);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        
        $user = $this->service->saveOrUpdateDetails($inputData,$id);
        if ($user) {
            Session::flash('success_message', 'User updated!');
            return Redirect::route('admin.user.edit', ['user' => $user->id]);
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id)) {
            $deleted = $this->service->deleteById($id);
            if ($deleted) {
                Session::flash('success_message', 'User deleted successfully!');

                return Redirect::route('admin.user.list');
            }
        }

        Session::flash('error', 'Oops something went wrong !');

        return Redirect::route('admin.user.list');
    }

}
