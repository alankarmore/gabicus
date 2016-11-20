<?php

namespace App\Services\Admin;

use URL;
use Input;
use Validator;
use App\Models\Forum;
use App\Services\BaseService;

class ForumService extends BaseService
{

    public function __construct()
    {
        ;
    }

    /**
     * 
     * @return type
     * @throws \Exception
     */
    public function getAllForums()
    {
        try {
            $response = array('total' => 0, 'rows' => '');
            $allCategories = Forum::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allCategories->cnt;
            $query = Forum::select('id', 'question','description','category_id');
            $search = Input::get('search');
            if (!empty($search)) {
                $query->where('question', 'LIKE', '%' . Input::get('search') . '%');
            }
            $sort = Input::get('sort') ? Input::get('sort') : "ID";
            $order = Input::get('order') ? Input::get('order') : "DESC";
            $forums = $query->orderBy($sort, $order)
                    ->skip(Input::get('offset'))->take(Input::get('limit'))
                    ->get();
            if (!empty($search)) {
                $response['total'] = $forums->count();
            }

            foreach ($forums as $forum) {
                $forum->question = ucwords($forum->question);
                $forum->category_name = ucwords($forum->forumCategory->category_name);
                $forum->description = substr(strip_tags($forum->description),0,50);
                $forum->action = '<a href="' . URL::route('admin.forums.edit', array('id' => $forum->id)) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
                if ($forum->answers->count() == 0) {
                    $forum->action .= ' <a href="' . URL::route('admin.forums.destroy', array('id' => $forum->id)) . '" title="delete" class="deleteRecord"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
                } else {
                    $forum->action .= ' <a href="javascript:void(0);" title="Not allowed to delete as comments are bind to this forum"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>';
                }

                $response['rows'][] = $forum;
            }

            return json_encode($response);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getForum($id)
    {
        try {
            return Forum::where('id', '=', $id)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function save($data)
    {
        try {

            $forum = new Forum();
            $forum->question = trim($data['question']);
            $forum->slug = self::slugify($forum->question);
            $forum->status = 1;
            $forum->created_at = date("Y-m-d H:i:s");
            $forum->updated_at = date("Y-m-d H:i:s");

            return $forum->save();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function update($id, $data)
    {
        try {
            $forum = $this->getForum($id);
            $forum->question = trim($data['question']);
            $forum->slug = self::slugify($forum->question);
            $forum->updated_at = date("Y-m-d H:i:s");

            return $forum->save();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function delete($id)
    {
        try {
            $forum = $this->getForum($id);
            if ($forum->id) {
                return $forum->delete();
            }

            return false;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function validate($data, $id = null)
    {
        try {
            $rules = array('question' => 'required|max:150','description' => 'required');

            return Validator::make($data, $rules);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}