<?php

namespace App\Services\Admin;

use Validator;
use App\Models\Category;

class CategoryService
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
            return Category::all();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getCategory($id)
    {
        try {
            return Category::where('id','=',$id)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function save($data)
    {
        try {
            $category = new Category();
            $category->category_name = trim($data['category_name']);
            $category->slug = strtolower(str_replace(" ","-",$category->category_name)) ;
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
            $rules = array('category_name' => 'required|max:150|unique:categories');
            if($id) {
                $rules['category_name'] = 'required|max:150|unique:categories,category_name,'.$id;
            }

            return Validator::make($data, $rules);
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}