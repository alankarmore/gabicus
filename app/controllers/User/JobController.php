<?php

namespace App\Controllers\User;

use App\Services\User\JobService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Models\Job;

class JobController extends \BaseController
{
    protected $jobIds = array();

    public function __construct()
    {

        $this->service = new JobService();
        parent::__construct();
        if($this->user->role->role_id == 3) {
            $jobs = $this->user->userJobs()->select('job_id')->get()->toArray();
            if($jobs) {
                $this->jobIds = array_map(function($entry) {return $entry['job_id'];},$jobs);
            }
        }
    }

    public function index()
    {
        try {
            $metaTitle = 'Create Job';
            $metaKeyword = 'Job, create';
            $metaDescription = 'Create Job';
            $user = $this->user;
            $categories = $this->service->getJobCategories();
            if(false == $categories) {
                $categories = null;
            }
            
            return View::make('jobs.create')->with(compact('metaTitle', 'metaKeyword', 'metaDescription', 'user', 'categories'));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function create()
    {
        try {
            $data = Input::all();
            $validation = $this->service->validate($data, 'create');
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $result = $this->service->create($this->user, $data);
            if ($result) {
                return Redirect::route('job.create')->with('success', 'Job has been posted successfully!');
            }
            
            return Redirect::route('job.create')->with('error', 'Something went wrong!');
        } catch (\Exception $ex) {
            return Redirect::route('job.create')->with('error', 'Something went wrong!');
        }
    }

    public function lists()
    {
        try {
            $metaTitle = 'Job Lists';
            $metaKeyword = 'Job, list';
            $metaDescription = 'Job,List';
            $user = $this->user;
            $categories = $this->service->getJobCategories(true);
            $cat = Input::get('cat')?trim(Input::get('cat')):null;
            $sort = Input::get('sort')?trim(Input::get('sort')):'latest';
            $limit = Input::get('pagesize')?trim(Input::get('pagesize')):10;
            $jobs = $this->service->getAllJobs($cat,$sort,$limit);

            return View::make('jobs.list')->with(compact('metaTitle', 'metaKeyword', 'metaDescription', 'user', 'jobs', 'categories','cat','sort','limit'));
            
        } catch (\Exception $ex) {
            $jobs = false;
            return View::make('jobs.list')->with(compact('metaTitle', 'metaKeyword', 'metaDescription', 'user', 'jobs', 'categories'));
        }
    }


    public function view($id)
    {
        try {

            $job = Job::findOrFail($id);
            $metaTitle = "$job->title";
            $metaKeyword = 'job, details';
            $metaDescription = "$job->description";
            $user = $this->user;
            $jobIds = $this->jobIds;

            return View::make('jobs.view')->with(compact('metaTitle', 'metaKeyword', 'metaDescription', 'user', 'job','jobIds'));
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function myPostedJobs()
    {
        try {
            $metaTitle = 'my Job Lists';
            $metaKeyword = 'my Job, list';
            $metaDescription = 'my Job,List';
            $user = $this->user;
            $sort = Input::get('sort')?trim(Input::get('sort')):'latest';
            $limit = Input::get('pagesize')?trim(Input::get('pagesize')):10;
            $jobs = $this->service->getAllMyPostedJobs($sort,$limit);

            return View::make('recruiter.list')->with(compact('metaTitle', 'metaKeyword', 'metaDescription', 'user', 'jobs','sort','limit'));

        } catch (\Exception $ex) {
            $jobs = false;
            return View::make('recruiter.list')->with(compact('metaTitle', 'metaKeyword', 'metaDescription', 'user', 'jobs'));
        }
    }

    public function apply()
    {
        $id = Input::get('id');
        $response = array('valid' => 0, 'message' => 'Something went wrong');
        if(!empty($id)) {
           $applied = $this->service->applyForJob($id);
           if($applied) {
               $response['valid'] = 1;
               $response['message'] = 'success';
           }
        }

        return json_encode($response);

    }
}