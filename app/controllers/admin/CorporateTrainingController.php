<?php

namespace App\Controllers\Admin;

use View;
use Redirect;
use App\Services\Admin\CorporateTrainingService;

class CorporateTrainingController extends \BaseController
{

    public function __construct()
    {
        $this->service = new CorporateTrainingService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return View::make('admin.corporatetraining.index');
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
            $corporateTraining = $this->service->getRecordDetails($id);
            if ($corporateTraining) {
                return View::make('admin.corporatetraining.show', ['corporateTraining' => $corporateTraining]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while showing the record details');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}