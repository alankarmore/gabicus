<?php

use Input;
use App\Services\EnrollService;

class EnrollController extends BaseController
{

    public function save()
    {
        try {
            $errorMessage = array();            
            $inputData = Input::all();
            $enrollService = new EnrollService();
            $validation = $enrollService->validate($inputData);
            if ($validation->fails()) {
                $errors = $validation->messages();
                foreach ($errors->getMessages() as $rule => $error) {
                    foreach ($error as $key => $value) {
                        $errorMessage[$rule] = $value;
                    }
                }
            } else {
                $saved = $enrollService->save($inputData);
                if ($saved) {
                    $errorMessage['success'] = 'Thank you for your showing your interest. We will get back to you very soon!';
                }
            }            
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        
        @header('Content-type', 'application/json');
        echo json_encode($errorMessage);
        exit(0);        
    }
    
    public function teachWithUs()
    {
        try {
            return View::make('enroll.teach');
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

}
