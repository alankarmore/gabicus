<?php

namespace App\Services\Admin;

use App\Models\Student;
use URL;
use Hash;
use Input;
use Mail;
use Validator;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Helpers\FileHelper;
use App\Models\UserRoleAssociation;

class UserService
{
    CONST USER_STUDENT = 'student';
    /**
     * Get all menus
     * 
     * @return json
     */
    public function getRecords()
    {
        $response = array('total' => 0, 'rows' => '');
        $allUsers = User::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allUsers->cnt;
        $search = Input::get('search');
        $query = User::select('id', 'first_name', 'last_name', 'email', 'user_type', 'is_active');
        if (!empty($search)) {
            $query->where('first_name', 'LIKE', '%' . Input::get('search') . '%');
        }

        $users = $query->orderBy(Input::get('sort'), Input::get('order'))
                ->skip(Input::get('offset'))->take(Input::get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $users->count();
        }

        foreach ($users as $user) {
            $user->first_name = ucfirst($user->first_name);
            $user->last_name = ucfirst($user->last_name);
            $user->action = '<a href="' . URL::route('admin.user.show', ['id' => $user->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('admin.user.edit', ['id' => $user->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('admin.user.destroy', ['id' => $user->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            $response['rows'][] = $user;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\User
     */
    public function getDetailsById($id)
    {
        return User::find($id);
    }

    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\UserRequest $request
     * @param array $data
     * @param integer $id
     * @return App\User
     */
    public function saveOrUpdateDetails($data,$id = null)
    {
        $timeStamp = Carbon::now();
        $user = new User();
        if (!empty($id)) {
            $user = $this->getDetailsById($id);
            $user->updated_at = date("Y-m-d H:i:s");
        } else {
            $user->is_active = 0;
            $user->created_at = date("Y-m-d H:i:s");
        }

        $token = Input::get('_token');
        $user->first_name = trim($data['first_name']);
        $user->last_name = trim($data['last_name']);
        $password = $this->generatePassword();
        $user->password = Hash::make($password);
        $user->email = trim($data['email']);
        $user->gender = trim($data['gender']);
        $user->user_type = trim($data['user_type']);
        $user->remember_token = $token.strtotime($timeStamp);

        $saved = $user->save();
        if($saved) {
            if(self::USER_STUDENT  == $user->user_type) {
                $student = new Student();
                if($id) {
                 $student = $user->student();
                }

                $student->user_id = $user->id;
                $student->save();

                if($id == null) {
                    $data['password'] = $password;
                    $data['remember_token'] = $user->remember_token;
                    Mail::send('emails.admin.welcome', $data, function($message) use ($data) {
                        $message->to($data['email'], $data['first_name'] . " " . $data['last_name'])->subject('Welcome!');
                    });

                    if ('recruiter' ==  $user->user_type) {
                        $role = Role::where('name', 'recruiter')->first();
                    } else {
                        $role = Role::where('name', 'user')->first();
                    }

                    $userRoleAssociationData = array(
                        'user_id' => $user->id,
                        'role_id' => $role->id,
                        'created_at' => $timeStamp,
                        'updated_at' => $timeStamp,
                    );

                    UserRoleAssociation::create($userRoleAssociationData);
                }
            }

            return $user;
        }

        return false;
    }

    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $user = $this->getDetailsById($id);
        if ($user) {
            return $user->delete();
        }

        return false;
    }

    public function validate($data, $id = null)
    {
        try {

            $rules = array(
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                //'password' => 'required|max:30',
                'gender' => 'required',
                //'phone_no' => 'regex:/^\d{8,12}$/',
                //'mobile_no' => 'required|regex:/^\d{10}$/',
                'user_type' => 'required',
                //'mobile_no' => 'required|min:10:max:12',
            );

            if($id) {
                $rules['email'] = 'required|email|max:255|unique:users,email,'.$id.',id';
            }
            $messages = array(
                'first_name.required' => 'First name is missing',
                'first_name.max' => 'First name must be less than 255 characters',
                'last_name.required' => 'Last name is missing',
                'last_name.max' => 'Last name must be less than 255 characters',
                'email.required' => 'Email address is missing',
                'email.email' => 'Enter valid email address',
                'email.max' => 'Email must be less than 255 characters',
                'email.unique' => 'Email address already being used',
                'user_type.required' => 'Select your profession',
                //'mobile_no.required' => 'Mobile number is missing',
                //'mobile_no.min' => 'Mobile number must not be less than 10 digits',
                //'mobile_no.max' => 'Mobile number must be less than 12 digits',
            );
            
            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Generate random password for the user.
     * @return string
     */
    private function generatePassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}
