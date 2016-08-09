<?php

use App\Services\CourseService;

class CourseController extends BaseController
{

    public function show($name)
    {
        try {
            $courseService = new CourseService();
            $course = $courseService->getCourseDetailsBySlug($name);
            
            if (!Cache::has('courses')) {
                $categoryCourses = $courseService->getCoursesAccordingToCategory();
            } else {
                $categoryCourses = Cache::get('courses');
            }
            return View::make('courses.show',array('course' => $course,'categoryCourses' => $categoryCourses));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        
    }

}
