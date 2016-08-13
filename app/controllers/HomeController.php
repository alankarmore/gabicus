<?php


use App\Models\CMSMenu;
use App\Models\ContactUs;
use App\Services\CourseService;
use App\Services\ContactService;

class HomeController extends BaseController
{
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */
    
    public function index()
    {
        $courseService = new CourseService();
        $popularCourses = $courseService->getPopularCourses();

        return View::make('index',array('popularCourses' => $popularCourses));
    }
    
    public function getCourses()
    {
        $courseService = new CourseService();
        $phrase = trim(Input::get('phrase'));
        $courses =  $courseService->getCourses($phrase);
        
        return json_encode($courses);
    }

    public function aboutus()
    {
        $menu = $this->getMenuDetails(CMSMenu::MENU_ABOUT_US);
        return View::make('about',array('menu' => $menu));
    }

    public function services()
    {
        $menu = $this->getMenuDetails(CMSMenu::MENU_SERVICES);
        return View::make('services',array('menu' => $menu));
    }

    public function contactUs()
    {
        return View::make('contact');
    }

    public function postContactUs()
    {
        try {
            $errorMessage = array();
            $inputData = Input::all();
            $contactService = new ContactService();
            $validation = $contactService->validate($inputData);
            if ($validation->fails()) {
                $errors = $validation->messages();
                foreach ($errors->getMessages() as $rule => $error) {
                    foreach ($error as $key => $value) {
                        $errorMessage[$rule] = $value;
                    }
                }
            } else {
                $saved = $contactService->save($inputData);
                if ($saved) {
                    $errorMessage['success'] = 'Thank you for your showing your interest. We will get back to you very soon!';
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        @header('Content-type', 'application/json');
        echo json_encode($errorMessage);
        exit(0);
    }

    public function postQuery()
    {
        try {
            $errorMessage = array();
            $inputData = Input::all();
            $contactService = new ContactService();
            $validation = $contactService->validateQueryForm($inputData);
            if ($validation->fails()) {
                $errors = $validation->messages();
                foreach ($errors->getMessages() as $rule => $error) {
                    foreach ($error as $key => $value) {
                        $errorMessage[$rule] = $value;
                    }
                }
            } else {
                $saved = $contactService->saveQuery($inputData);
                if ($saved) {
                    $errorMessage['success'] = 'Thank you for your showing your interest. We will get back to you very soon!';
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        @header('Content-type', 'application/json');
        echo json_encode($errorMessage);
        exit(0);
    }

    public function getMenuDetails($id)
    {
        return CMSMenu::find($id);
    }

}
