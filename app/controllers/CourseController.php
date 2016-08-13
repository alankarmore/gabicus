<?php

use App\Services\CourseService;

class CourseController extends BaseController
{

    public function show($name)
    {
        try {
            $courseService = new CourseService();
            $course = $courseService->getCourseDetailsBySlug($name);
            if(!empty($course) && $course->id) {
                return View::make('courses.show',array('course' => $course));
            }

            return Redirect::to("/");
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        
    }

}
