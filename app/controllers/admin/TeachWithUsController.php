<?php

namespace App\Controllers\Admin;

use View;
use Redirect;
use App\Services\Admin\TeachWithUsService;

class TeachWithUsController extends \BaseController
{

    public function __construct()
    {
        $this->service = new TeachWithUsService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
          return View::make('admin.teachwithus.index');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * get all courses
     * 
     * @return json
     */
    public function getData()
    {
        return $this->service->getAllRecords();
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
            $teachwithus = $this->service->getRecordDetails($id);
            if ($teachwithus) {
                return View::make('admin.teachwithus.show', ['teachwithus' => $teachwithus]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while showing the record details');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}