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
			return View::make('user.auth.register',compact('metaTitle','metaKeyword','metaDescription'));
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
						'is_active' => TRUE
					));
					$status = 'success';
					$message="Your account is confirmed, you can now login to your account";
				}
			}
			return Redirect::route("user.signin")->with($status,$message);
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function confirmEmail(){
		try {
			$data = Input::all();
			$user  =User::where('email',$data['email'])->count();
			if($user){
				echo "false";
			}else{
				echo "true";
			}
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

}
