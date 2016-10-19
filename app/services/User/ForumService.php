<?php

namespace App\Services\User;

use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\Forum;
use App\Models\ForumAnswer;
use App\Services\BaseService;
use App\Models\ForumCategory;

class ForumService extends BaseService
{

    public function getForumCategories()
    {
        $forums = ForumCategory::where('status', '=', \DB::raw(1))->orderBy('category_name', 'ASC')->get();
        if (isset($forums) && $forums->count() > 0) {
            return $forums;
        }

        return false;
    }

    public function create($user, $data)
    {
        try {
            $timeStamp = Carbon::now();
            $data['category_id'] = $data['forum_category'];
            unset($data['forum_category']);
            $data['user_id'] = $user->id;
            $data['slug'] = self::slugify($data['question']);
            $data['created_at'] = $timeStamp;
            
            return Forum::create($data);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getAllForums()
    {
        try {
            $response = array('total' => 0, 'rows' => '');
            $allForums = Forum::select(\DB::raw('COUNT(*) as cnt'))->where('status','=',\DB::raw(1))->first();
            $response['total'] = $allForums->cnt;
            $query = Forum::select('id', 'category_name');
            $search = Input::get('search');
            if (!empty($search)) {
                $query->where('category_name', 'LIKE', '%' . Input::get('search') . '%');
            }
            $sort = Input::get('sort') ? Input::get('sort') : "created_at";
            $order = Input::get('order') ? Input::get('order') : "DESC";
            $forums = $query->where('status','=',\DB::raw(1))
                    ->orderBy($sort, $order)
                    ->skip(Input::get('offset'))->take(Input::get('limit'))
                    ->get();
            if (!empty($search)) {
                $response['total'] = $forums->count();
            }

            foreach ($forums as $forum) {
                $forum->question = ucwords($forum->question);
                $response['rows'][] = $forum;
            }
            
            return json_encode($response);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
        
        /*return Forum::where('status','=',\DB::raw(1))
                    ->orderBy('created_at', 'desc')
                    ->paginate(2);*/
    }

    public function comment($user, $data, $id)
    {
        try {
            $timeStamp = Carbon::now();
            $data['user_id'] = $user->id;
            $data['forum_id'] = $id;
            $data['created_at'] = $timeStamp;

            return ForumAnswer::create($data);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function validate($data, $action)
    {
        try {
            if ($action == 'create') {
                $rules = array(
                    'forum_category' => 'required',
                    'question' => 'required|max:150',
                    'description' => 'required',
                );
            }
            if ($action == 'comment') {
                $rules = array(
                    'answers' => 'required',
                );
            }
            return Validator::make($data, $rules);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}