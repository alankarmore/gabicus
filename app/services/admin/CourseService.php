<?php

namespace App\Services\Admin;

use Validator;
use App\Models\Course;

class CourseService
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
    public function getAllCourses()
    {
        try {
            return Course::all();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function getCourse($id)
    {
        try {
            return Course::where('id','=',$id)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function save($data)
    {
        try {
            $course = new Course();
            $course->title = trim($data['title']);
            $course->description = trim(nl2br($data['description']));
            $course->slug = strtolower(str_replace(" ","-",$course->title));
            if($data['course_image']) {
                $extension = $data['course_image']->guessExtension();
                $newFileName = time().".".$extension;
                $data['course_image']->move(public_path('uploads/course/'),$newFileName);
                $course->image_name = $newFileName;
            }
            
            $course->created_at = date("Y-m-d H:i:s");
            $course->updated_at = date("Y-m-d H:i:s");
            if($course->save()) {
                return $course;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function update($id,$data)
    {
        try {
            $course = $this->getCourse($id);
            $course->title = trim($data['title']);
            $course->description = trim(nl2br($data['description']));
            $course->slug = strtolower(str_replace(" ","-",$course->title));
            if($data['course_image']) {
                $extension = $data['course_image']->guessExtension();
                $newFileName = time().".".$extension;
                $data['course_image']->move(public_path('uploads/course/'),$newFileName);
                if($course->image_name && file_exists(public_path('uploads/course/').$course->image_name)) {
                    unlink(public_path('uploads/course/').$course->image_name);
                }
                
                $course->image_name = $newFileName;
            }
            
            $course->created_at = date("Y-m-d H:i:s");
            $course->updated_at = date("Y-m-d H:i:s");
            if($course->save()) {
                return $course;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function delete($id)
    {
        try {
            $course = $this->getCourse($id);
            if($course->id) {
                if($course->image_name && file_exists(public_path('uploads/course/').$course->image_name)) {
                    unlink(public_path('uploads/course/').$course->image_name);
                }
                
                return $course->delete();
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
                'title' => 'required|max:150|unique:courses',
                'description' => 'required',
                'course_image' => 'required|mimes:jpg,jpeg,png,bmp',
                );
            
            if($id) {
                $rules['title'] = 'required|max:150|unique:courses,title,'.$id;
                $rules['course_image'] = 'mimes:jpg,jpeg,png,bmp';
            }

            return Validator::make($data, $rules);
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}