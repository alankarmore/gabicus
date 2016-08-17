<?php

namespace App\Controllers\Admin;


use Input;
use Session;
use View;
use Redirect;
use App\Services\Admin\SEOService;

class SEOManagementController extends \BaseController
{

    public function __construct()
    {
        $this->service = new SEOService();
    }

    public function edit()
    {
        $seoInformation = $this->service->getSEOInformation();

        return View::make('admin.seo.edit',['seo' => $seoInformation]);
    }

    /**
     * Updating the seo details.
     *
     * @param integer $id
     * @return mixed RedirectResponse
     */
    public function update($id)
    {
        $inputData = Input::all();
        $isUpdate = $this->service->updateDetails($inputData,$id);
        if ($isUpdate) {
            Session::flash('success_message', 'Menu updated!');
            return Redirect::route('admin.seo');
        }

        return back()->withInput();
    }
}