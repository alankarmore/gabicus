<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{

    public function __construct()
    {
        ;
    }

    /**
     * 
     * @return type
     * @throws \Exception
     */
    public function getAllCourses()
    {
        try {
            return Course::all();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * 
     * @return type
     * @throws \Exception
     */
    public function getCourseDetailsBySlug($slug)
    {
        try {
            return Course::where('slug','=',$slug)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}