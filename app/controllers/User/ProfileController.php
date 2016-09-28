<?php
namespace App\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Services\User\ProfileService;
use App\Models\College;
use App\Models\EducationDegree;
use App\Models\EducationCourseType;
use App\Models\Month;
use App\Models\Year;
use App\Models\State;

class ProfileController extends \BaseController {

	public function __construct()
	{
		$this->service = new ProfileService();
		$this->user = Auth::user();
	}

	public function view()
	{
		try {
			$metaTitle = 'User Profile View';
			$metaKeyword = 'user, profile, view';
			$metaDescription = 'User Profile View';
			$user = $this->user;
			return View::make('user.profile.view')->with(compact('metaTitle','metaKeyword','metaDescription','user'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function edit()
	{
		try {
			$metaTitle = 'User Profile Edit';
			$metaKeyword = 'user, profile, edit';
			$metaDescription = 'User Profile Edit';
			$user = $this->user;
			$colleges = College::all();
			$degrees = EducationDegree::all();
			$courseTypes = EducationCourseType::all();
			$months = Month::all();
			$years = Year::all();
			$states = State::all();
			return View::make('user.profile.edit')->with(compact('metaTitle','metaKeyword','metaDescription','user','colleges','degrees','courseTypes','months','years','states'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function update()
	{
		try {
			$data = Input::all();
			if($this->user->user_type=='student'){
				$validation = $this->service->validate($data,'student','profile');
			}elseif($this->user->user_type=='employee'){
				$validation = $this->service->validate($data,'employee','profile');
			}else{
				$validation = $this->service->validate($data,'none','profile');
			}
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			$update = $this->service->update($this->user);
			if ($update) {
				return Redirect::route('user.profile.edit')->with('success','Profile updated successfully!');
			}
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function passwordUpdate()
	{
		try {
			$data = Input::only('current_password','password','password_confirmation');
			if(!Hash::check($data['current_password'],$this->user->password)){
				return Redirect::back()->with('error','Current password not matched');
			}
			$validation = $this->service->validate($data,'none','password');
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			$update = $this->service->passwordUpdate($this->user,$data['password']);
			if ($update) {
				return Redirect::route('user.profile.edit')->with('success','Password updated successfully!');
			}
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}
}
