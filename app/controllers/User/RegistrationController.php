<?php
namespace App\Controllers\User;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Services\User\AuthService;

class RegistrationController extends \BaseController {

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function index()
    {
        try {
            $metaTitle = 'User Registration';
            $metaKeyword = 'user, registration';
            $metaDescription = 'User Registration';
            $states = $this->service->getStates();

            return View::make('user.auth.register',compact('metaTitle','metaKeyword','metaDescription','states'));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function create()
    {
        try {
            $inputData = Input::all();
            $inputData = $this->trimData($inputData);
            $validation = $this->service->validate($inputData);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $registered = $this->service->register($inputData);
            if ($registered) {
                return Redirect::route('user.signin')->with('success','Account registered successfully, please check email to confirm your email');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while registration');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function confirm($token){
        try {
            $user = User::where('remember_token', $token)->first();
            if ($user == null) { // no record found
                $status = 'error';
                $message= "Sorry!! No User found";
            }else {
                if ($user->is_active) { // already confirmed
                    $status = 'success';
                    $message="Your account already confirmed";
                } else {
                    User::where('remember_token', $token)->update(array(
                        'is_active' => TRUE,
                        'remember_token' => ''
                    ));
                    $status = 'success';
                    $message="Your account is confirmed, you can now login to your account";
                }
            }

            return Redirect::route("user.signin")->with($status,$message);
        } catch (\Exception $ex) {
            $status = 'error';
            $message= "Sorry!! No User found";

            return Redirect::route("user.signin")->with($status,$message);
        }
    }

    public function confirmEmail(){
        try {
            $email = trim(Input::get('email'));
            if(!empty($email)) {
                $user = User::where('email','=',$email)->count();
                if($user){
                    echo "false";
                    exit;
                }
            }

            echo "true";
            exit;
        } catch (\Exception $ex) {
            echo "true";
            exit;
        }
    }

    public function getCities()
    {
        $response = array('valid' => 0, 'response' => null);
        $state = Input::get('stateId');
        if(!empty($state) && (int) $state > 0) {
            $cities = $this->service->getCitiesByState($state);
            if($cities) {
                $optionString = "<option value=''>Select City</option>";
                foreach($cities as $city) {
                    $optionString .=  '<option value="'.$city->id.'">'.ucfirst($city->name).'</option>';
                }

                $response['valid'] = 1;
                $response['response'] = $optionString;
            }
        }

        return json_encode($response);
    }
}
