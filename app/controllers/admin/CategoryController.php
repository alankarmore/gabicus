<?php

namespace App\Controllers\Admin;

use View;
use Input;
use Session;
use Redirect;
use App\Services\Admin\CategoryService;

class CategoryController extends \BaseController
{

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $categories = $this->service->getAllCategories();

            return View::make('admin.categories.index', array('categories' => $categories));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $inputData = Input::all();
            $validation = $this->service->validate($inputData);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $category = $this->service->save($inputData);
            if ($category) {
                Session::flash('success_message','Category has been added successfuly');
                return Redirect::route('admin.categories');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the category');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $category = $this->service->getCategory($id);
            if ($category) {
                return View::make('admin.categories.edit', ['category' => $category]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the category');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try {
            $inputData = Input::all();
            $validation = $this->service->validate($inputData, $id);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $category = $this->service->update($id, $inputData);
            if ($category) {
                Session::flash('success_message','Category has been updated successfuly');
                return Redirect::route('admin.categories');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the category');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $isDeleted = $this->service->delete($id);
            if ($isDeleted) {
                Session::flash('success_message','Category has been deleted successfuly');
                return Redirect::route('admin.categories');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while deleting the category');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}