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
    
    /**
     * Get pouplar courses 
     * 
     * @param integer $limit
     * @return App\Models\Course
     * @throws \Exception
     */
    public function getPopularCourses($limit = 5)
    {
        try {
            return Course::where('is_popular','=',\DB::raw(1))
                           ->orderBy('id','DESC') 
                           ->take($limit)
                            ->get();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
}