<?php

namespace App\Controllers\Admin;

use Input;
use Session;
use View;
use Redirect;
use App\Services\Admin\CMSMenuService;

class CMSMenuController extends \BaseController
{

    public function __construct()
    {
        $this->service = new CMSMenuService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.menu.index');
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
        $parentMenus = $this->service->getParentMenus();

        return View::make('admin.menu.create', ['parentMenus' => $parentMenus]);
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

        $menu = $this->service->saveOrUpdateDetails();
        if ($menu) {
            Session::flash('success_message', 'Menu has been saved successfully!');

            return Redirect::route('admin.menu.edit', ['id' => $menu->id]);
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
            $menuDetails = $this->service->getDetailsById($id);
           
            return View::make('admin.menu.show', ['menu' => $menuDetails]);
        }

        return Redirect::route('admin.menu.list');
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
            $menuDetails = $this->service->getDetailsById($id);
            $parentMenus = $this->service->getParentMenus();

            return View::make('admin.menu.edit', ['menu' => $menuDetails, 'parentMenus' => $parentMenus]);
        }

        return Redirect::route('admin.menu.list');
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
        
        $menu = $this->service->saveOrUpdateDetails($id);
        if ($menu) {
            Session::flash('success_message', 'Menu updated!');
            return Redirect::route('admin.menu.edit', ['menu' => $menu]);
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
                Session::flash('success_message', 'Menu deleted successfully!');

                return Redirect::route('admin.menu.list');
            }
        }

        Session::flash('error', 'Oops something went wrong !');

        return Redirect::route('admin.menu.list');
    }

}
