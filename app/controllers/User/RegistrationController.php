<?php
namespace App\Controllers\User;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Services\User\AuthService;

class RegistrationController extends \BaseController {

	public function __construct()
	{
		$this->service = new AuthService();
	}

	public function index()
	{
		try {
			return View::make('user.auth.register');
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function create()
	{
		try {
			$inputData = Input::all();
			$inputData = $this->trimData($inputData);
			$validation = $this->service->validate($inputData);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation->messages());
			}

			$registered = $this->service->register($inputData);
			if ($registered) {
				return Redirect::to('admin/sign-in');
			}

			return Redirect::back()->withInput()->withErrors('Something went wrong while registration');
		} catch (\Exception $ex) {
			throw new \Exception($ex->getMessage(), $ex->getCode());
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
