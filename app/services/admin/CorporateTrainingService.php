<?php

namespace App\Services\Admin;

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
            return CorporateTraining::all();
        } catch (\Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getCode());
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