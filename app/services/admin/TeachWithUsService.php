<?php

namespace App\Services\Admin;

use URL;
use Input;
use App\Models\TeachWithUs;

class TeachWithUsService
{

    public function __construct()
    {
        ;
    }

    public function getAllRecords()
    {

        try {
            $response = array('total' => 0, 'rows' => '');
            $allInquiries = TeachWithUs::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allInquiries->cnt;
            $query = TeachWithUs::select('id','name','email','qualification','age','message','location','contact_number','itexperience','training_courses','resume');
            if (!empty(Input::get('search'))) {
                $query->where('name', 'LIKE', '%' . Input::get('search') . '%');
            }

            $inquiries = $query->orderBy(Input::get('sort'), Input::get('order'))
                                ->skip(Input::get('offset'))->take(Input::get('limit'))
                                ->get();
            if (!empty(Input::get('search'))) {
                $response['total'] = $inquiries->count();
            }

            foreach ($inquiries as $inquiry) {
                $inquiry->name = ucwords($inquiry->name);
                $inquiry->email = $inquiry->email;
                $inquiry->message = ucfirst($inquiry->message);
                $inquiry->location = ucfirst($inquiry->location);
                $inquiry->itexperience= ucfirst($inquiry->itexperience);
                $inquiry->action = '<a href="' . URL::route('admin.teachwithus.show', array('id' => $inquiry->id)) . '" title="show details"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                    <a href="' . URL::route('file.download', array('id' => $inquiry->resume)) . '" title="Download Resume"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>';
                $response['rows'][] = $inquiry;
            }

            return json_encode($response);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getRecordDetails($id)
    {
        try {
            return TeachWithUs::find($id);
        } catch (\Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getCode());
        }
    }
}