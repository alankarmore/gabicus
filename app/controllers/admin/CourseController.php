<?php

namespace App\Controllers\Admin;

use Session;
use View;
use Input;
use Redirect;
use App\Services\Admin\CourseService;

class CourseController extends \BaseController
{

    public function __construct()
    {
        $this->service = new CourseService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            return View::make('admin.courses.index');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }
    
    /**
     * get all courses
     * 
     * @return json
     */
    public function getData()
    {
        return $this->service->getAllCourses();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categoriese = $this->service->getCategories();
        
        return View::make('admin.courses.create',['categories' => $categoriese]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $inputData = Input::all();
            $validation = $this->service->validate($inputData);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $course = $this->service->saveOrUpdateDetails($inputData);
            if ($course) {
                Session::flash('success_message','Course has been added successfuly');
                return Redirect::route('admin.courses.show',array('id' => $course->id));
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the course');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $course = $this->service->getCourse($id);
            if ($course) {
                return View::make('admin.courses.show', ['course' => $course]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while showing the course details');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $course = $this->service->getCourse($id);
            $categories = $this->service->getCategories();
            if ($course) {
                return View::make('admin.courses.edit', ['course' => $course, 'categories' => $categories]);
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the course');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try {
            $inputData = Input::all();
            $validation = $this->service->validate($inputData, $id);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $course = $this->service->saveOrUpdateDetails($inputData,$id);
            if ($course) {
                Session::flash('success_message','Course has been updated successfuly');
                return Redirect::route('admin.courses.show',array('id' => $course->id));
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while saving the course');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $isDeleted = $this->service->delete($id);
            if ($isDeleted) {
                Session::flash('success_message','Course has been deleted successfuly');
                return Redirect::route('admin.courses');
            }

            return Redirect::back()->withInput()->withErrors('Something went wrong while deleting the course');
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}