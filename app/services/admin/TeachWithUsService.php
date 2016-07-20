<?php

namespace App\Services\Admin;

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
            return TeachWithUs::all();
        } catch (\Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getCode());
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