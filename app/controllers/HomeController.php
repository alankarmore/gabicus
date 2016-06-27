<?php

use App\Models\ContactUs;
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
        return View::make('index');
    }

    public function aboutus()
    {
        return View::make('about');
    }

    public function services()
    {
        return View::make('services');
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

}
