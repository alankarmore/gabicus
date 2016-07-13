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

    public function postTeachWithUs()
    {
        try {
            
            $message = '';            
            $inputData = Input::all();
            $enrollService = new EnrollService();
            $validation = $enrollService->validateTeachWithUs($inputData);
            if ($validation->fails()) {
                $errors = $validation->messages();
                
                return Redirect::back()->withInput()->withErrors($errors);
            }  
            $saved = $enrollService->saveTeachWithUs($inputData);
             if ($saved) {
                 $message = 'Thank you for your interest. We will get back to you very soon!';
                 
                 return Redirect::route('teach-with-us')
                        ->with('message', $message);
             }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
    
    public function downloadResume($file)
    {
        try {
            $filePath = 'uploads/resume/' . $file;
            
            return Response::download(public_path($filePath));
        } catch (\Exception $exc) {
            
        }
    }
    
    public function corporateTraining()
    {
        try {
            return View::make('enroll.corporate-training');
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }        
    }

    public function postCorporateTraining()
    {
        try {
            
            $message = '';            
            $inputData = Input::all();
            $enrollService = new EnrollService();
            $validation = $enrollService->validateCorporateTraining($inputData);
            if ($validation->fails()) {
                $errors = $validation->messages();

                return Redirect::back()->withInput()->withErrors($errors);
            }  
            $saved = $enrollService->saveCorporateData($inputData);
             if ($saved) {
                 $message = 'Thank you for your interest. We will get back to you very soon!';
                 
                 return Redirect::route('corporate-training')
                        ->with('message', $message);
             }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }    
}
