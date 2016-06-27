<?php

namespace App\Services\Admin;

use Validator;
use App\Models\Alumni;

class AlumniService
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
    public function getAllAlumnies()
    {
        try {
            return Alumni::all();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getAlumni($id)
    {
        try {
            return Alumni::where('id','=',$id)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function save($data)
    {
        try {
            $alumni = new Alumni();
            $alumni->person_name = trim($data['person_name']);
            $alumni->description = trim(nl2br($data['description']));
            if($data['image_name']) {
                $extension = $data['image_name']->guessExtension();
                $newFileName = time().".".$extension;
                $data['image_name']->move(public_path('uploads/alumni/'),$newFileName);
                $alumni->image_name = $newFileName;
            }
            
            $alumni->created_at = date("Y-m-d H:i:s");
            $alumni->updated_at = date("Y-m-d H:i:s");
            if($alumni->save()) {
                return $alumni;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function update($id,$data)
    {
        try {
            $alumni = $this->getAlumni($id);
            $alumni->person_name = trim($data['person_name']);
            $alumni->description = trim($data['description']);
            if($data['image_name']) {
                $extension = $data['image_name']->guessExtension();
                $newFileName = time().".".$extension;
                $data['image_name']->move(public_path('uploads/alumni/'),$newFileName);
                if($alumni->image_name && file_exists(public_path('uploads/alumni/').$alumni->image_name)) {
                    unlink(public_path('uploads/alumni/').$alumni->image_name);
                }
                
                $alumni->image_name = $newFileName;
            }
            
            $alumni->created_at = date("Y-m-d H:i:s");
            $alumni->updated_at = date("Y-m-d H:i:s");
            if($alumni->save()) {
                return $alumni;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function delete($id)
    {
        try {
            $alumni = $this->getAlumni($id);
            if($alumni->id) {
                if($alumni->image_name && file_exists(public_path('uploads/alumni/').$alumni->image_name)) {
                    unlink(public_path('uploads/alumni/').$alumni->image_name);
                }
                
                return $alumni->delete();
            }
            
            return false;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function validate($data, $id = null)
    {
        try {
            $rules = array(
                'person_name' => 'required|max:150',
                'description' => 'required',
                'image_name' => 'required|mimes:jpg,jpeg,png,bmp',
                );
            
            if($id) {
                $rules['image_name'] = 'mimes:jpg,jpeg,png,bmp';
            }

            return Validator::make($data, $rules);
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}