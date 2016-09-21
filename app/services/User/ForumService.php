<?php

namespace App\Services\User;

use Auth;
use Carbon\Carbon;
use Validator;
use App\Models\Forum;
use App\Models\ForumAnswer;


class ForumService
{

    public function create($user,$data)
    {
        try {
            $timeStamp = Carbon::now();
            $data['user_id'] = $user->id;
            $data['created_at'] = $timeStamp;
            $data['updated_at'] = $timeStamp;
            Forum::create($data);
            return true;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function comment($user,$data,$id)
    {
        try {
            $timeStamp = Carbon::now();
            $data['user_id'] = $user->id;
            $data['forum_id'] = $id;
            $data['created_at'] = $timeStamp;
            $data['updated_at'] = $timeStamp;
            ForumAnswer::create($data);
            return true;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }


    public function validate($data,$action)
    {
        try {
            if($action=='create') {
                $rules = array(
                    'question' => 'required|max:150',
                    'description' => 'required|max:150',
                );
            }
            if($action=='comment') {
                $rules = array(
                    'answers' => 'required|max:150',
                );
            }
            return Validator::make($data, $rules);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}