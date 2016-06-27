<?php

namespace App\Services;

use Validator;
use Mail;
use App\Models\Enroll;
use App\Models\Course;

class EnrollService
{

    public function __construct()
    {
        ;
    }

    public function save($data)
    {
        try {
            $response = false;
            $enroll = new Enroll;
            $enroll->name = $data['name'];
            $enroll->email = $data['email'];
            $enroll->course = $data['course'];
            $enroll->qualification = $data['qualification'];
            $enroll->age = $data['age'];
            $enroll->experience = ($data['experience']) ? $data['experience'] : null;
            if($enroll->save()) {
                $this->sendMail($data);
                $this->sendMailToCustomer($data);
                $response = true;
                
                return $response;
            }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
    
    public function sendMail($data)
    {
        try{
            $course = Course::find($data['course']);
            $data['course_title'] = $course->title;
            $data['experience'] = ($data['experience']) ? $data['experience'] : 'Non';
            $viewParams = array('data' => $data);
            Mail::send('emails.enroll',$viewParams,function($message) {
                    //$message->to('vikas.sharma@gabicusindia.com','Vikas Sharma')
                    $message->to('alankar.more@gmail.com','Alankar More')
                            ->to('mulay.yogesh@gabicusindia.com', 'Yogesh Mulay')
                            ->subject('New Request from user via Contact Us form');
            });
        }catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function sendMailToCustomer($data)
    {
        try{

            $viewParams = array('data' => $data);
            Mail::send('emails.customer',$viewParams,function($message) use($data){
                $message->to($data['email'],  ucwords($data['name']))
                        ->subject('No Reply: Thank you to reach us');
            });
        }catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }    
    }  
    
    public function validate($data, $id = null)
    {
        try {
            $rules = array(
                'name' => 'required|max:150',
                'email' => 'required|email',
                'qualification' => 'required|max:200'
            );

            $messages = array(
                'name.required' => 'Please enter your name',
                'name.max' => 'Name must not be greater that 150 character',
                'qualification.required' => 'Please enter your Qualification',
                'qualification.max' => 'Qualification must not be greater that 200 character',
                'email.required' => 'Please enter your email',
                'email.email' => 'Enter valid email address'
            );

            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}
