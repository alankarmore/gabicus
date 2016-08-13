<?php

namespace App\Services\Admin;

use URL;
use Input;
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
            $response = array('total' => 0, 'rows' => '');
            $allAluminies = Alumni::select(\DB::raw('COUNT(*) as cnt'))->first();
            $response['total'] = $allAluminies->cnt;
            $query = Alumni::select('id', 'person_name','description');
            $search = Input::get('search');
            if (!empty($search)) {
                $query->where('person_name', 'LIKE', '%' . Input::get('search') . '%');
            }

            $aluminies = $query->orderBy(Input::get('sort'), Input::get('order'))
                    ->skip(Input::get('offset'))->take(Input::get('limit'))
                    ->get();
            if (!empty($search)) {
                $response['total'] = $aluminies->count();
            }
            
            foreach ($aluminies as $alumini) {
                $alumini->description = (strlen($alumini->description) > 150) ? substr($alumini->description, 0, 130) : $alumini->description;
                $alumini->action = '<a href="' . URL::route('admin.alumnies.edit', array('id' => $alumini->id)) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    <a href="' . URL::route('admin.alumnies.delete', array('id' => $alumini->id)) . '" title="delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
                $response['rows'][] = $alumini;
            }

            return json_encode($response);
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