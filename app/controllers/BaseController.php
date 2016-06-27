<?php

use View;
use App\Services\CourseService;

class BaseController extends Controller {

        protected $service;
        
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
        
        public function __construct()
        {
            $courseService = new CourseService();
            $courses = $courseService->getAllCourses();
            View::share(array('courses' => $courses));
            
        }

}
