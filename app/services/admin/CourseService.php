<?php

namespace App\Services\Admin;

use URL;
use Input;
use Validator;
use App\Helpers\FileHelper;
use App\Models\Category;
use App\Models\Course;

class CourseService
{

    public function __construct()
    {
        ;
    }
    
    public function getCategories()
    {
        return Category::all();
    }

    /**
     * 
     * @return type
     * @throws \Exception
     */
    public function getAllCourses()
    {
        try {
        $response = array('total' => 0,'rows' => '');
        $allCourses = Course::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allCourses->cnt;
        $query = Course::select('courses.id', 'title', 'description','categories.category_name')
                         ->join('categories','courses.category_id','=','categories.id');
        $search = Input::get('search');
        if(!empty($search)) {
            $query->where('courses.title', 'LIKE', '%' . Input::get('search') . '%');
        }
        
        $courses = $query->orderBy(Input::get('sort'), Input::get('order'))
                       ->skip(Input::get('offset'))->take(Input::get('limit'))
                       ->get();
        if(!empty($search)) {
            $response['total'] = $courses->count();
        }
        
        foreach($courses as $course) {
            $course->description = ($course->description && strlen($course->description) > 100) ? strip_tags(substr($course->description, 0, 100)).'...' : strip_tags($course->description);
            $course->action = '<a href="'.URL::route('admin.courses.show',array('id' => $course->id)).'" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                            <a href="'.URL::route('admin.courses.edit',array('id' => $course->id)).'" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a href="'.URL::route('admin.courses.delete',array('id' => $course->id)).'" title="delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
            
            $response['rows'][] = $course;
        }
        
        return json_encode($response);
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
    
    public function saveOrUpdateDetails($data,$id = null)
    {
        try {
            $course = new Course();
            if(!empty($id)) {
                $course = $this->getCourse($id);
                $course->updated_at = date("Y-m-d H:i:s");                
            }
            
            $course->category_id = trim($data['category']);
            $course->is_popular = (!empty($data['popular']) && (int)trim($data['popular']))?1:0;
            $course->title = trim($data['title']);
            $course->description = trim($data['description']);
            $course->location = trim($data['location']);
            $course->fees = trim($data['fees']);
            $course->slug = strtolower(str_replace(" ","-",$course->title));
            $file = trim(Input::get('fileName'));
            if (isset($file) && !empty($file)) {
                if (!empty($id)) {
                    $previousPath = public_path('uploads/course/' . $course->image_name);
                    if (file_exists($previousPath)) {
                        @unlink($previousPath);
                    }
                }

                $fileHelper = new FileHelper();
                $tempPath = public_path('uploads/temp/' . $file);
                if (file_exists($tempPath)) {
                    $destination = public_path('uploads/course/' . $file);
                    $fileHelper->moveFile($tempPath, $destination);
                    $course->image_name = $file;
                }
            } 
            
            $course->created_at = date("Y-m-d H:i:s");
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
                'category' => 'required',
                'title' => 'required|max:150|unique:courses',
                'location' => 'required|max:200',
                'fees' => 'required|numeric',
                'description' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png,bmp',
                );
            
            if($id) {
                $rules['title'] = 'required|max:150|unique:courses,title,'.$id;
                $rules['image'] = 'mimes:jpg,jpeg,png,bmp';
            }

            return Validator::make($data, $rules);
       } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
}