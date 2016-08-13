<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Category;

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

    /**
     * 
     * @return type
     * @throws \Exception
     */
    public function getCourseDetailsBySlug($slug)
    {
        try {
            return Course::where('slug','=',$slug)->first();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    /**
     * Get pouplar courses 
     * 
     * @param integer $limit
     * @return App\Models\Course
     * @throws \Exception
     */
    public function getPopularCourses($limit = 5)
    {
        try {
            return Course::where('is_popular','=',\DB::raw(1))
                           ->orderBy('id','DESC') 
                           ->take($limit)
                            ->get();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
    
    public function getCoursesAccordingToCategory()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $response = array();
        foreach($categories as $category) {
            $categoryCourses = Course::select('id','title','slug')
                                ->where('category_id','=',$category->id)
                                ->orderBy('title','ASC')
                                ->get();
            if(!empty($categoryCourses) && $categoryCourses->count() > 0) {
               $response[$category->category_name] = $categoryCourses; 
            }
        }
        
        return $response;
    }
    
    public function getCourses($phrase)
    {
        try {
            $response = array();
            $courses = Course::select('courses.id','courses.title','courses.slug')
                           ->where('courses.title', 'LIKE', '%' . $phrase . '%')
                           ->orderBy('courses.title','ASC') 
                           ->get();
            if(!empty($courses) && $courses->count() > 0) {
                foreach($courses as $course) {
                    $temp = array();
                    $temp['text'] = ucfirst($course->title);
                    $temp['link'] = route('courses.show',$course->slug);
                    $response[] = $temp;
                }
            }
            
            return $response;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }        
    }
}