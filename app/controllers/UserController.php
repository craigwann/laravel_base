<?php

class UserController extends \BaseController {
    protected $user;
    protected $userType;

    function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository) {
        $this->user = $userRepository;
        $this->userType = $userTypeRepository;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->index();
        return View::make('user.index', array('users' => $users));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('user.create', array('user_type_options' => $this->userType->listOptions()));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$result = $this->user->store(Input::all());
        if (!$result) {
            return Redirect::route('user.create')->withInput()->withErrors($this->user->errors());
        } else {
            return Redirect::route('user.index')->with('message', 'User created!');
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
