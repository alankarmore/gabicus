<?php

namespace App\Services\User;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Student;
use App\Models\Employee;
use App\Models\College;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ProfileService
{

    public function update($data)
    {
        try {
            $user = Auth::user();
            $user->first_name = trim($data['first_name']);
            $user->last_name = trim($data['last_name']);
            $user->birth_date = date("Y-m-d",strtotime($data['birth_date']));
            $user->state_id = trim($data['state']);
            $user->city_id = trim($data['city']);
            $user->phone_no = trim($data['phone_no']);
            $user->mobile_no = trim($data['mobile_no']);
            $user->gender = trim($data['gender']);

            $file = $data['fileName'];
            if(isset($file) && !empty($file)) {
                if(!empty($id)) {
                    $previousPath = public_path('uploads/user/' . $user->profile_image);
                    if(file_exists($previousPath)) {
                        @unlink($previousPath);
                    }
                }

                $fileHelper = new FileHelper();
                $tempPath = public_path('uploads/temp/' . $file);
                if(file_exists($tempPath)) {
                    $destination = public_path('uploads/user/' . $file);
                    $fileHelper->moveFile($tempPath, $destination);
                    $user->profile_image = $file;
                }
            } else {
                $user->profile_image = null;
            }

            // saving users details
            $user->save();
            if($user->user_type == 'student'){
	        	$student = $user->student ?: new Student;
                $student->passing_year = trim($data['year']);
                $student->passing_month = trim($data['month']);
                $student->college_name = trim($data['college_name']);
                $student->university_name = trim($data['university_name']);
                $student->education_degree_id = trim($data['education_degree_id']);
                $student->education_course_type_id = trim($data['education_course_type_id']);
                $student->college_state_id = trim($data['college_state']);
                $student->college_city_id = trim($data['college_city']);

		        return $user->student()->save($student);
            }

            if($user->user_type == 'employee') {
                $employeeData = Input::only('company_name','designation','specialization','total_it_experience','total_experience','location');

                return Employee::where('user_id',$user->id)->update($employeeData);
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function passwordUpdate($user,$password)
    {
        try {
            $password = Hash::make($password);
            User::where('id',$user->id)->update(array('password'=>$password));
            return TRUE;
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getCollegesByStateAndCity($state,$city)
    {
        $colleges = College::select('id','name')
                            ->where('state_id','=',$state)
                            ->where('city_id','=',$city)
                            ->get();
        if($colleges) {
            return $colleges;
        }

        return false;
    }

    public function validate($data,$for = null,$type)
    {
        try {
            if($type=='profile'){
                $data['state_id'] = $data['state'];
                unset($data['state']);
                $rules = array(
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'birth_date' => 'required',
                    'state_id' => 'required',
                    'profile_image' => 'mimes:jpg,jpeg,png',
                    'city' => 'required|max:150',
                    'phone_no' => 'regex:/^\d{8,12}$/',
                    'mobile_no' => 'required|regex:/^\d{10}$/'
                );
                if($for=='student'){
                    $rules['college_state'] = 'required';
                    $rules['college_city'] = 'required';
                    $rules['education_degree_id'] = 'required';
                    $rules['education_course_type_id'] = 'required';
                    $rules['month'] = 'required';
                    $rules['year'] = 'required';
                    $rules['university_name'] = 'required|max:255';
                    $rules['college_name'] = 'required|max:255';
                }
                if($for=='employee'){
                    $rules['company_name'] = 'required|max:50';
                    $rules['designation'] = 'required|max:50';
                    $rules['specialization'] = 'required|max:20';
                    $rules['total_it_experience'] = 'required|regex:/^\d{1,2}$/';
                    $rules['total_experience'] = 'required|regex:/^\d{1,2}$/';
                    $rules['location'] = 'required|max:50';
                }
            }elseif($type=='password'){
                $rules = array(
                    'current_password' => 'required|max:30',
                    'password' => 'required|confirmed|max:30',
                );
            }

            $messages = array(
                'college_state.required' => 'Select college state',
                'college_city.required' => 'Select your college city',
                'profile_image.mimes' => 'Images with extension jpg, jpeg,and png are allowed',
                'education_degree_id.required' => 'Select your degree',
                'education_course_type_id.required' => 'Select your specialization trim',
                'month.required' => 'Select month of passing',
                'year.required' => 'Select year of passing',
                'university_name.required' => 'Enter your university name',
                'college_name.required' => 'Enter your college name',
                'phone_no.regex' => 'Phone number should be number and in between 8 to 12 digits',
                'mobile_no.regex' => 'Mobile number should be number and it should be 10 digits',
                'year.regex' => 'Year should be number and it should be 4 digits',
                'total_it_experience.regex' => 'Total IT Exp should be number and it should be 1-2 digits',
                'total_experience.regex' => 'Total Exp should be number and it should be 1-2 digits',
            );
            return Validator::make($data, $rules,$messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}
