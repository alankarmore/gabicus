<?php
namespace App\Controllers\User;

use App\Models\City;
use Cache;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Services\User\ProfileService;
use App\Models\College;
use App\Models\EducationDegree;
use App\Models\EducationCourseType;
use App\Models\State;
use App\Models\Forum;

class ProfileController extends \BaseController {

	public function __construct()
	{
		$this->service = new ProfileService();
        parent::__construct();
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
            $months = array('January','February','March','April','May','June','July','August','September','October','November','December');
            Cache::forget('colleges');Cache::forget('degrees');Cache::forget('courseTypes');
            if(Cache::has('degrees')) {
                $degrees = Cache::get('degrees');
            } else {
                $degrees = EducationDegree::orderBy('name','ASC')->get();
                Cache::put('degrees',$degrees,120);
            }

            if(Cache::has('courseTypes')) {
                $courseTypes = Cache::get('courseTypes');
            } else {
                $courseTypes = EducationCourseType::orderBy('name','ASC')->get();
                Cache::put('courseTypes',$courseTypes,120);
            }

            if(Cache::has('states')) {
                $states = Cache::get('states');
            } else {
                $states = State::all();
                Cache::put('states',$states,120);
            }

            $cities = City::getCitiesByState($this->user->state_id);
	    $collegeCities = City::getCitiesByState($this->user->state_id);

			return View::make('user.profile.edit')->with(compact('metaTitle','metaKeyword','metaDescription','user','colleges','degrees','courseTypes','states','cities','months','collegeCities'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function update()
	{
		try {
			$data = Input::all();
            $validation = $this->service->validate($data,$this->user->user_type,'profile');
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}

			$update = $this->service->update($data);

			if ($update) {
				return Redirect::route('user.profile.edit')->with('success','Profile updated successfully!');
			}
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

    public function changePassword()
    {
        return View::make('user.profile.change-password');
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
				return Redirect::route('user.change-password')->with('success','Password updated successfully!');
			}
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function publicProfile($id)
	{
		try {
			$metaTitle = 'User Profile View';
			$metaKeyword = 'user, profile, view';
			$metaDescription = 'User Profile View';
			$user = User::findOrFail($id);
			$forums = Forum::where('user_id',$id)->paginate(5);
			return View::make('user.profile.public')->with(compact('metaTitle','metaKeyword','metaDescription','user','forums'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

    public function getColleges()
    {
        $response = array('valid' => 0, 'response' => null);
        $state = Input::get('stateId');
        $city = Input::get('cityId');
        if(!empty($state) && (int) $state > 0 && !empty($city) && (int) $city > 0) {
            $colleges = $this->service->getCollegesByStateAndCity($state,$city);
            if($colleges) {
                $optionString = "<option value=''>Select College</option>";
                foreach($colleges as $college) {
                    $optionString .=  '<option value="'.$college->id.'">'.ucfirst($college->name).'</option>';
                }

                $response['valid'] = 1;
                $response['response'] = $optionString;
            }
        }

        return json_encode($response);
    }
}
