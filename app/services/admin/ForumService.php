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
    public function getAllForumns()
    {
        try {
            $response = array('total' => 0, 'rows' => '');
            $allCategories = Forum::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allCategories->cnt;
            $query = Forum::select('id', 'question');
            $search = Input::get('search');
            if (!empty($search)) {
                $query->where('question', 'LIKE', '%' . Input::get('search') . '%');
            }
            $sort = Input::get('sort') ? Input::get('sort') : "ID";
            $order = Input::get('order') ? Input::get('order') : "DESC";
            $forumns = $query->orderBy($sort, $order)
                    ->skip(Input::get('offset'))->take(Input::get('limit'))
                    ->get();
            if (!empty($search)) {
                $response['total'] = $forumns->count();
            }

            foreach ($forumns as $forumn) {
                $forumn->question = ucwords($forumn->question);
                $forumn->action = '<a href="' . URL::route('admin.forumns.edit', array('id' => $forumn->id)) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
                if ($forumn->forums->count() == 0) {
                    $forumn->action .= ' <a href="' . URL::route('admin.forumns.delete', array('id' => $forumn->id)) . '" title="delete" class="deleteRecord"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
                } else {
                    $forumn->action .= ' <a href="javascript:void(0);" title="Not allowed to delete as courses are bind to this category"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>';
                }

                $response['rows'][] = $forumn;
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

            $forumn = new Forum();
            $forumn->question = trim($data['category_name']);
            $forumn->slug = self::slugify($forumn->question);
            $forumn->status = 1;
            $forumn->created_at = date("Y-m-d H:i:s");
            $forumn->updated_at = date("Y-m-d H:i:s");

            return $forumn->save();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function update($id, $data)
    {
        try {
            $forumn = $this->getForum($id);
            $forumn->category_name = trim($data['category_name']);
            $forumn->slug = self::slugify($forumn->category_name);
            $forumn->updated_at = date("Y-m-d H:i:s");

            return $forumn->save();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function delete($id)
    {
        try {
            $forumn = $this->getForum($id);
            if ($forumn->id) {
                return $forumn->delete();
            }

            return false;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function validate($data, $id = null)
    {
        try {
            $rules = array('category_name' => 'required|max:150|unique:forum_categories');
            if ($id) {
                $rules['category_name'] = 'required|max:150|unique:forum_categories,category_name,' . $id . ',id,deleted_at,NULL';
            }

            return Validator::make($data, $rules);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}