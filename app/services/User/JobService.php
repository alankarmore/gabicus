<?php

namespace App\Services\User;

use Mail;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\UserJobs;
use App\Models\Category;
use App\Services\BaseService;

class JobService extends BaseService
{

    public function create($user, $data)
    {
        try {
            $timeStamp = Carbon::now();
            $data['recruiter_id'] = $user->id;
            $data['experience'] = $data['from_experience']."-".$data['to_experience'];
            $data['skills'] = trim($data['job_skills']);
            unset($data['from_experience'],$data['to_experience'],$data['job_skills']);
            $data['status'] = 1;
            $data['slug'] = self::slugify(trim($data['title']));
            $data['created_at'] = $timeStamp;

            return Job::create($data);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

    public function getJobCategories($withCount = false)
    {
        $query = Category::select('*');
        if($withCount) {
            $query = Category::select('categories.id','categories.category_name','categories.slug',\DB::raw('COUNT(jobs.id) as cnt'))
                ->leftJoin('jobs',function($join) {
                    $join->on('categories.id','=','jobs.category_id');
                    $join->on('jobs.status','=',\DB::raw('1'));
                })
                ->groupBy('categories.id')
                ->orderBy('cnt', 'DESC');
        } else {
            $query->orderBy('categories.category_name', 'ASC');
        }

        $categories = $query->get();
        if (isset($categories) && $categories->count() > 0) {
            return $categories;
        }
    }

    public function getAllJobs($cat = null,$sort = 'latest',$limit = 10)
    {
        $query = Job::where('status','=',\DB::raw(1));
        if($cat) {
            $category = Category::where('slug','=',$cat)->first();
            if($category) {
                $query = $query->where('category_id','=',$category->id);
            }
        }

        if($sort == 'latest') {
            $query->orderBy('created_at', 'DESC');
        } else if($sort == 'oldest') {
            $query->orderBy('created_at', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        return $query->paginate($limit);
    }

    public function getAllMyPostedJobs($sort = 'latest',$limit = 10)
    {
        $query = Job::where('status','=',\DB::raw(1))
            ->where('recruiter_id','=',Auth::user()->id);
        if($sort == 'latest') {
            $query->orderBy('created_at', 'DESC');
        } else if($sort == 'oldest') {
            $query->orderBy('created_at', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        return $query->paginate($limit);
    }

    public function applyForJob($id)
    {
        try {
            $userJobs = new UserJobs();
            $appliedUser = Auth::user()->id;
            $userJobs->user_id = $appliedUser;
            $userJobs->job_id = $id;

            if($userJobs->save()) {
                $this->sendMail($id,$appliedUser);
            }

            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    private function sendMail($jobId,$userId)
    {
        try{
            $data = array();
            $job = Job::find($jobId);
            $user = User::find($userId);

            $data['jobTitle'] = ucwords($job->title);
            $data['name'] = $user->first_name." ".$user->last_name;
            $data['course'] = ($user->student->education_course_type_id != NULL)? ucwords($user->student->course->name) : 'NA';
            $data['degree'] = ($user->student->education_degree_id != NULL)? ucwords($user->student->degree->name): 'NA';
            $data['collegeName'] = ($user->student->college_name != NULL)? ucwords($user->student->college_name): 'NA';
            $data['university'] = ($user->student->university_name != NULL)?ucwords($user->student->university_name): 'NA';
            $data['passingYear'] = ($user->student->passing_month != NULL && $user->student->passing_year != NULL)? $user->student->passing_month ." ".$user->student->passing_year: 'NA';

            $viewParams = array('data' => $data);
            Mail::send('emails.recruiter.applied-job',$viewParams,function($message) use($job) {
                $message->to('vikas.sharma@gabicusindia.com','Vikas Sharma')
                    ->to('mulay.yogesh@gabicusindia.com', 'Yogesh Mulay')
                    ->to($job->recruiter->email,$job->recruiter->first_name." ".$job->recruiter->last_name)
                    ->subject('User has applied for the job');
            });
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function validate($data, $action)
    {
        try {
            if ($action == 'create') {
                $rules = array(
                    'category_id' => 'required',
                    'title' => 'required|max:150',
                    'description' => 'required',
                    'qualification' => 'required|max:150',
                    'location' => 'required',
                );
            }

            $mesages = array(
                'category_id.required' => 'Select Job category',
                'title.required' => 'Title is missing',
                'title.max' => 'Title must not be greater than 100 characters',
                'location.required' => 'Location is missing',
                'location.max' => 'Location must not be greater than 100 characters',
                'qualification.required' => 'Qualification is missing',
                'qualification.max' => 'Qualification must not be greater than 150 characters',
                'skills.max' => 'Skills must not be greater than 150 characters',
                'description.required' => 'Description is missing',
            );

            return Validator::make($data, $rules,$mesages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}