<?php

namespace App\Services;

use Validator;
use Mail;
use App\Models\Enroll;
use App\Models\Course;
use App\Models\TeachWithUs;
use App\Models\CorporateTraining;

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
            if ($enroll->save()) {
                $course = Course::find($data['course']);
                $data['course_title'] = $course->title;
                $data['experience'] = ($data['experience']) ? $data['experience'] : 'Non';
                $viewParams = array('data' => $data);
                $this->sendMail($viewParams, 'emails.enroll','New Request from user via Contact Us form');
                $this->sendMailToCustomer($data);
                $response = true;

                return $response;
            }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function saveTeachWithUs($data)
    {
        try {
            $enroll = new TeachWithUs();
            $enroll->name = $data['name'];
            $enroll->email = $data['email'];
            $enroll->qualification = $data['qualification'];
            $enroll->age = $data['age'];
            $enroll->location = $data['location'];
            $enroll->contact_number = $data['contact_number'];
            $enroll->itexperience = ($data['itexperience']);
            $enroll->training_courses = ($data['training_courses']);
            $enroll->message = $data['message'];
            if($data['resume']) {
                $extension = $data['resume']->guessExtension();
                $newFileName = time().".".$extension;
                $data['resume']->move(public_path('uploads/resume/'),$newFileName);
                $enroll->resume = $newFileName;            
                $data['fileName'] = $newFileName;            
            }
            
            if ($enroll->save()) {
                $viewParams = array('data' => $data);
                $this->sendMail($viewParams, 'emails.teachwithus','New Request from user via teach with Us form');
                $this->sendMailToCustomer($data);
                
                return true;
            }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
        
        return false;
    }

    public function saveCorporateData($data)
    {
        try {
            $corporateTraining = new CorporateTraining();
            $corporateTraining->name = $data['name'];
            $corporateTraining->email = $data['email'];
            $corporateTraining->team_members = $data['team_members'];
            $corporateTraining->location = $data['location'];
            $corporateTraining->contact_number = ($data['contact_number']) ? $data['contact_number'] : "";
            $corporateTraining->courses_required = $data['courses_required'];
            if ($corporateTraining->save()) {
                $data['team_members'] = ($data['team_members'])?$data['team_members']:'Not specified';
                $viewParams = array('data' => $data);
                $this->sendMail($viewParams, 'emails.corporatetraining','New Request from user via corporate training form');
                $this->sendMailToCustomer($data);
                
                return true;
            }
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
        
        return false;
    }

    public function sendMail($viewParams, $templateName,$subject)
    {
        try {
            Mail::send($templateName, $viewParams, function($message) use($subject) {
                //$message->to('vikas.sharma@gabicusindia.com','Vikas Sharma') 
                $message->to('alankar.more@gmail.com', 'Alankar More')
                        //->to('mulay.yogesh@gabicusindia.com', 'Yogesh Mulay')
                        ->subject($subject);
            });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function sendMailToCustomer($data)
    {
        try {

            $viewParams = array('data' => $data);
            Mail::send('emails.customer', $viewParams, function($message) use($data) {
                $message->to($data['email'], ucwords($data['name']))
                        ->subject('No Reply: Thank you to reach us');
            });
        } catch (\Exception $e) {
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

    public function validateTeachWithUs($data, $id = null)
    {
        try {
            $rules = array(
                'name' => 'required|max:150',
                'age' => 'required',
                'email' => 'required|email',
                'qualification' => 'required|max:200',
                'location' => 'required',
                'itexperience' => 'required|max:200',
                'contact_number' => 'required|max:12|min:10',
                'training_courses' => 'required|max:200',
                'resume' => 'required|mimes:doc,docx,pdf',
                'message' => 'required|max:200',
            );

            $messages = array(
                'name.required' => 'Please enter your name',
                'name.max' => 'Name must not be greater that 150 character',
                'qualification.required' => 'Please enter your Qualification',
                'qualification.max' => 'Qualification must not be greater that 200 character',
                'email.required' => 'Please enter your email',
                'email.email' => 'Enter valid email address',
                'location.required' => 'Enter your IT experience ',
                'itexperience.required' => 'Enter your IT experience ',
                'itexperience.max' => 'ITExperience must not be greater that 200 character',
                'contact_number.required' => 'Enter your contact number',
                'contact_number.max' => 'Contact number must not be greater that 200 character',
                'contact_number.min' => 'Contact number must be atleast 10 digits',
                'training_courses.required' => 'Enter training courses you can conduct',
                'training_courses.max' => 'Training courses must not be greater that 200 character',
                'resume.required' => 'Please upload your resume',
                'resume.mimes' => 'Resume must be in doc,docx,pdf format',
                'message.required' => 'Enter your message',
                'message.max' => 'Message must not be greater that 200 character'
            );

            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function validateCorporateTraining($data, $id = null)
    {
        try {
            $rules = array(
                'name' => 'required|max:150',
                'team_members' => 'required',
                'email' => 'required|email',
                'location' => 'required',
                'contact_number' => 'required|max:12|min:10',
                'courses_required' => 'required|max:200',
            );

            $messages = array(
                'name.required' => 'Please enter your name',
                'name.max' => 'Name must not be greater that 150 character',
                'team_members.required' => 'Please select team members',
                'email.required' => 'Please enter your email',
                'email.email' => 'Enter valid email address',
                'location.required' => 'Enter your location',
                'contact_number.required' => 'Enter your contact number',
                'contact_number.max' => 'Contact number must not be greater that 200 character',
                'contact_number.min' => 'Contact number must be atleast 10 digits',
                'courses_required.required' => 'Enter training courses you can conduct',
                'courses_required.max' => 'Training courses must not be greater that 200 character',
            );

            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}
