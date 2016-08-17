<?php

namespace App\Services;

use Validator;
use Mail;
use Carbon\Carbon;
use App\Models\ContactUs;
use App\Models\Query;

class ContactService
{

    public function __construct()
    {
        ;
    }

    public function save($data) 
    {
        $response = false;
        try{
            $contact = new ContactUs();

            $contact->name = $data['name'];            
            $contact->email = $data['email'];            
            $contact->subject = $data['subject'];            
            $contact->message = $data['message'];            
            $contact->created_at = Carbon::now();
            
            if($contact->save()) {
                $this->sendMail($data);
                $this->sendMailToCustomer($data);
                $response = true;

                return $response;
            }

        }catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function saveQuery($data) 
    {
        $response = false;
        try{
            $query = new Query();

            $query->name = $data['name'];            
            $query->email = $data['email'];            
            $query->contact_number = $data['country'].$data['contact_number'];            
            $query->message = $data['message'];            
            $query->training_for = ($data['training_for']) ? $data['training_for'] : 0;
            $query->created_at = Carbon::now();
            
            if($query->save()) {
                $this->sendQueryMail($data);
                $this->sendMailToCustomer($data);
                $response = true;

                return $response;
            }

        }catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function sendMail($data)
    {
        try{
            $viewParams = array('data' => $data);
            Mail::send('emails.contact',$viewParams,function($message) {
                    //$message->to('vikas.sharma@gabicusindia.com','Vikas Sharma')
                    //        ->to('mulay.yogesh@gabicusindia.com', 'Yogesh Mulay')
                $message->to('alankar.more@gmail.com', 'Alankar More')
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

    private function sendQueryMail($data)
    {
        try{

            $viewParams = array('data' => $data);
            $viewParams['data']['training_for'] = ($data['training_for']) ? 'My team/ Organisation' : 'My Self';
            Mail::send('emails.query',$viewParams,function($message) {
                $message->to('vikas.sharma@gabicusindia.com','Vikas Sharma')
                        ->to('mulay.yogesh@gabicusindia.com', 'Yogesh Mulay')
                        ->subject('New query for user');
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
                'subject' => 'required|max:200',
                'email' => 'required|email',
                'message' => 'required'
            );

            $messages = array(
                'name.required' => 'Please enter your name',
                'name.max' => 'Name must not be greater that 150 character',
                'subject.required' => 'Please enter your subject',
                'subject.max' => 'Subject must not be greater that 200 character',
                'email.required' => 'Please enter your email',
                'email.email' => 'Enter valid email address',
                'message.required' => 'Please enter your message'
            );
            
            return Validator::make($data, $rules,$messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
   
    public function validateQueryForm($data, $id = null)
    {
         try {
            $rules = array(
                'name' => 'required|max:150',
                'country' => 'required',
                'contact_number' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            );

            $messages = array(
                'name.required' => 'Please enter your name',
                'name.max' => 'Name must not be greater that 150 character',
                'contact_number.required' => 'Please enter your contact number',
                'email.required' => 'Please enter your email',
                'email.email' => 'Enter valid email address',
                'message.required' => 'Please enter your message'
            );
            
            return Validator::make($data, $rules,$messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}