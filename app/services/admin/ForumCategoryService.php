<?php

namespace App\Services\Admin;

use URL;
use Input;
use Validator;
use App\Models\ForumCategory;
use App\Services\BaseService;

class ForumCategoryService extends BaseService
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
    public function getAllCategories()
    {
        try {
            $response = array('total' => 0, 'rows' => '');
            $allCategories = ForumCategory::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allCategories->cnt;
            $query = ForumCategory::select('id', 'category_name');
            $search = Input::get('search');
            if (!empty($search)) {
                $query->where('category_name', 'LIKE', '%' . Input::get('search') . '%');
            }
            $sort = Input::get('sort')?Input::get('sort'):"ID";
            $order = Input::get('order')?Input::get('order'):"DESC";
            $categories = $query->orderBy($sort,$order)
                    ->skip(Input::get('offset'))->take(Input::get('limit'))
                    ->get();
            if (!empty($search)) {
                $response['total'] = $categories->count();
            }

            foreach ($categories as $category) {
                $category->category_name = ucwords($category->category_name); 
                $category->action = '<a href="' . URL::route('admin.forumcategories.edit', array('id' => $category->id)) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
                if ($category->forums->count() > 0) {
                    $category->action .= ' <a href="javascript:void(0);" title="Not allowed to delete as courses are bind to this category"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>';
                } else {
                    $category->action .= ' <a href="' . URL::route('admin.forumcategories.delete', array('id' => $category->id)) . '" title="delete" class="deleteRecord"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
                }

                $response['rows'][] = $category;
            }

            return json_encode($response);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getCategory($id)
    {
        try {
            return ForumCategory::where('id','=',$id)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function save($data)
    {
        try {

            $category = new ForumCategory();
            $category->category_name = trim($data['category_name']);
            $category->slug = self::slugify($category->category_name) ;
            $category->status = 1;
            $category->created_at = date("Y-m-d H:i:s");
            $category->updated_at = date("Y-m-d H:i:s");

            return $category->save();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function update($id,$data)
    {
        try {
            $category = $this->getCategory($id);
            $category->category_name = trim($data['category_name']);
            $category->slug = strtolower(str_replace(" ","-",$category->category_name));
            $category->updated_at = date("Y-m-d H:i:s");

            return $category->save();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function delete($id)
    {
        try {
            $category = $this->getCategory($id);
            if($category->id) {
                return $category->delete();
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
            if($id) {
                $rules['category_name'] = 'required|max:150|unique:forum_categories,category_name,'.$id.',id,deleted_at,NULL';
            }

            return Validator::make($data, $rules);
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}