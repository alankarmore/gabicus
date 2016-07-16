<?php

namespace App\Controllers\Admin;

use Session;
use View;
use Input;
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
            $enrollments = $this->service->getAllEnrollments();

            return View::make('admin.enroll.index', array('enrollments' => $enrollments));
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