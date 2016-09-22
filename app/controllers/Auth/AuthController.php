<?php
namespace App\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRoleAssociation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AuthController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show()
	{
		try {
			return View::make('user.auth.login');
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function login()
	{
		try {
			$data = Input::all();
			$user = User::where('email', $data['email'])->first();
			if ($user == NULL || empty($user)) {
				$message="The email address is invalid";
			}elseif($user->is_active == 0){
				$message="Please verify your email id first";
			}elseif(Auth::attempt(['email' => $data['email'],'password' => $data['password']])){
				$user = Auth::user();
				if('recruiter'==$user->user_type){
					return Redirect::to('recruiter/dashboard');
				}elseif('student' == $user->user_type || 'employee' == $user->user_type || 'none' == $user->user_type){
					return Redirect::to('user/profile/edit');
				}else{
					return Redirect::to('/');
				}
			}else{
				$message="The email address or password is invalid";
			}
			return Redirect::back()->with('error',$message);
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function logout()
	{
		try {
			Auth::logout();
			return Redirect::to('user/sign-in')->with('success','Logged out successfully');
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

}
