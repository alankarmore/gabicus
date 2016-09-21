<?php
namespace App\Controllers\User;

use App\Services\User\ForumService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Models\Forum;

class ForumController extends \BaseController {

	public function __construct()
	{
		$this->service = new ForumService();
		$this->user = Auth::user();
	}

	public function index(){
		try {
			$metaTitle = 'Create Forum';
			$metaKeyword = 'forum, create';
			$metaDescription = 'Create Forum';
			$user = $this->user;
			return View::make('user.forum.create')->with(compact('metaTitle','metaKeyword','metaDescription','user'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function create(){
		try {
			$data = Input::all();
			$validation = $this->service->validate($data,'create');
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			$result = $this->service->create($this->user,$data);
			if ($result) {
				return Redirect::to('forum/create')->with('success','Question added to forum successfully!');
			}
			return Redirect::to('forum/create')->with('error','Something went wrong!');
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function lists(){
		try {
			$metaTitle = 'Forum Lists';
			$metaKeyword = 'forum, list';
			$metaDescription = 'Forum List';
			$user = $this->user;
			$forums = Forum::paginate(5);
			return View::make('user.forum.list')->with(compact('metaTitle','metaKeyword','metaDescription','user','forums'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function view($id){
		try {
			$forum = Forum::findOrFail($id);
			$views = $forum->views+1;
			Forum::where('id',$id)->update(array('views'=>$views));
			$metaTitle = "$forum->question";
			$metaKeyword = 'forum, details';
			$metaDescription = "$forum->description";
			$user = $this->user;
			return View::make('user.forum.view')->with(compact('metaTitle','metaKeyword','metaDescription','user','forum'));
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function comment($id){
		try {
			$data = Input::all();
			$validation = $this->service->validate($data,'comment');
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}
			$result = $this->service->comment($this->user,$data,$id);
			if ($result) {
				return Redirect::to("forum/view/$id")->with('success','Comment added to forum successfully!');
			}
			return Redirect::to("forum/view/$id")->with('error','Something went wrong!');
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}
}
