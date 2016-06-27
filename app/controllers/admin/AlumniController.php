<?php

namespace App\Controllers\Admin;

use Session;
use View;
use Input;
use Redirect;
use App\Services\Admin\AlumniService;

class AlumniController extends \BaseController
{

    public function __construct()
    {
        $this->service = new AlumniService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $alumnies = $this->service->getAllAlumnies();

            return View::make('admin.alumnies.index', array('alumnies' => $alumnies));
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
        return View::make('admin.alumnies.create');
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

            $alumni = $this->service->save($inputData);
            if ($alumni) {
                Session::flash('success_message','Alumni has been added successfuly');
                return Redirect::route('admin.alumnies.show',array('id' => $alumni->id));
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the alumni');
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
        try {
            $alumni = $this->service->getAlumni($id);
            if ($alumni) {
                return View::make('admin.alumnies.show', ['alumni' => $alumni]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while showing the alumni details');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
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
            $alumni = $this->service->getAlumni($id);
            if ($alumni) {
                return View::make('admin.alumnies.edit', ['alumni' => $alumni]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the alumni');
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

            $alumni = $this->service->update($id, $inputData);
            if ($alumni) {
                Session::flash('success_message','Alumni has been updated successfuly');
                return Redirect::route('admin.alumnies.show',array('id' => $alumni->id));
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the alumni');
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
                Session::flash('success_message','Alumni has been deleted successfuly');
                return Redirect::route('admin.alumnies');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while deleting the alumni');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}