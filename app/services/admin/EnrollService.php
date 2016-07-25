<?php

namespace App\Services\Admin;

use URL;
use Input;
use App\Models\Enroll;

class EnrollService
{

    public function __construct()
    {
        ;
    }

    public function getAllEnrollments()
    {
        try {
            $response = array('total' => 0, 'rows' => '');
            $allEnroll = Enroll::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allEnroll->cnt;
            $query = Enroll::select('enrollments.id', 'name','email','qualification','age','experience','courses.title');
            if (!empty(Input::get('search'))) {
                $query->where('name', 'LIKE', '%' . Input::get('search') . '%');
            }

            $enrollments = $query->join('courses','enrollments.course','=','courses.id')
                                ->orderBy(Input::get('sort'), Input::get('order'))
                                ->skip(Input::get('offset'))->take(Input::get('limit'))
                                ->get();
            if (!empty(Input::get('search'))) {
                $response['total'] = $enrollments->count();
            }

            foreach ($enrollments as $enroll) {
                $enroll->name = ucwords($enroll->name);
                $enroll->title = ucwords($enroll->title);
                $enroll->qualification = strtoupper($enroll->qualification);
                $enroll->action = '<a href="' . URL::route('admin.enroll.show', array('id' => $enroll->id)) . '" title="edit"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';
                $response['rows'][] = $enroll;
            }

            return json_encode($response);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getEnrollmentDetails($id)
    {
        try {
            return Enroll::find($id);
        } catch (\Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getCode());
        }
    }

}
