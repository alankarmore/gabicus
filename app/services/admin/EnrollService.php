<?php

namespace App\Services\Admin;

use Validator;
use Mail;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\TeachWithUs;
use App\Models\CorporateTraining;

class EnrollService
{

    public function __construct()
    {
        ;
    }

    public function getAllEnrollments()
    {
        try {
            return Enroll::all();
        } catch (\Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getCode());
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