<?php

namespace App\Services\Admin;

use Input;
use URL;
use App\Models\CorporateTraining;

class CorporateTrainingService
{

    public function __construct()
    {
        ;
    }

    public function getAllRecords()
    {
        try {
            $response = array('total' => 0, 'rows' => '');
            $allTrainings=  CorporateTraining::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allTrainings->cnt;
            $query = CorporateTraining::select('id', 'name','email','team_members','location','contact_number','courses_required');
            $search = Input::get('search');
            if (!empty($search)) {
                $query->where('name', 'LIKE', '%' . Input::get('search') . '%');
            }

            $trainings = $query->orderBy(Input::get('sort'), Input::get('order'))
                    ->skip(Input::get('offset'))->take(Input::get('limit'))
                    ->get();
            if (!empty($search)) {
                $response['total'] = $trainings->count();
            }

            foreach ($trainings as $training) {
                $training->name = ucwords($training->name);
                $training->location = ucwords($training->location);
                $training->courses_required = ucwords($training->courses_required);
                $training->action = '<a href="' . URL::route('admin.corporatetraining.show', array('id' => $training->id)) . '" title="edit"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';
                $response['rows'][] = $training;
            }

            return json_encode($response);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getRecordDetails($id)
    {
        try {
            return CorporateTraining::find($id);
        } catch (\Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getCode());
        }
    }
}