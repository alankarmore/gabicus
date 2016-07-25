<?php

namespace App\Controllers\Admin;

use View;
use Redirect;
use App\Services\Admin\EnrollService;

class EnrollController extends \BaseController
{

    public function __construct()
    {
        $this->service = new EnrollService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return View::make('admin.enroll.index');
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
        return $this->service->getAllEnrollments();
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
            $enroll = $this->service->getEnrollmentDetails($id);
            if ($enroll) {
                return View::make('admin.enroll.show', ['enroll' => $enroll]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while showing the enrollment details');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}