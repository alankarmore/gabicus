<?php

use App\Services\CourseService;

class CourseController extends BaseController
{

    public function show($name)
    {
        try {
            $courseService = new CourseService();
            $course = $courseService->getCourseDetailsBySlug($name);
            
            return View::make('courses.show',array('course' => $course));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        
    }

}
