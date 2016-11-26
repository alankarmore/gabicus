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

    public function getForumCategories($withCount = false)
    {
        $query = ForumCategory::select('*');
        if($withCount) {
            $query = ForumCategory::select('forum_categories.id','forum_categories.category_name','forum_categories.slug',\DB::raw('COUNT(forums.id) as cnt'))
                                    ->leftJoin('forums','forum_categories.id','=','forums.category_id')
                                    ->groupBy('forum_categories.id')
                                    ->orderBy('cnt', 'DESC');
        } else {
            $query->orderBy('forum_categories.category_name', 'ASC');
        }

        $forums = $query->where('forum_categories.status', '=', \DB::raw(1))

                                ->get();

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
            $data['status'] = 1;
            $data['slug'] = self::slugify($data['question']);
            $data['created_at'] = $timeStamp;
            
            return Forum::create($data);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getAllForums($cat = null,$sort = 'latest',$limit = 10)
    {
        $query = Forum::where('status','=',\DB::raw(1));
        if($cat) {
            $category = ForumCategory::where('slug','=',$cat)->first();
            if($category) {
                $query = $query->where('category_id','=',$category->id);
            }
        }

        if($sort == 'latest') {
            $query->orderBy('created_at', 'DESC');
        } else if($sort == 'oldest') {
            $query->orderBy('created_at', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        return $query->paginate($limit);
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