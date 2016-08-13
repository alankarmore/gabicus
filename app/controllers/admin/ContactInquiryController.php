<?php

namespace App\Controllers\Admin;

use View;
use Input;
use Session;
use Redirect;
use App\Services\Admin\ContactInquiryService;

class ContactInquiryController extends \BaseController
{

    public function __construct()
    {
        $this->service = new ContactInquiryService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.inquiries.index');
    }
    
    /**
     * get all inquiries
     * 
     * @return json
     */
    public function getData()
    {
        return $this->service->getRecords();
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
            $inquiryDetails = $this->service->getDetailsById($id);

            return View::make('admin.inquiries.show', ['inquiry' => $inquiryDetails]);
        }

        return Redirect::route('inquiries.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($id)) {
            $deleted = $this->service->deleteById($id);
            if($deleted) {
                Session::flash('success_message','Category has been deleted successfuly');
                return Redirect::route('admin.inquiries.list');                
            }
        }
        
        return Redirect::back()->withInput()->withErrors('Something went wrong while deleting the inquiry');
    }

}