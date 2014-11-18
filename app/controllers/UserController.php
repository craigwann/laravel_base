<?php

class UserController extends \BaseController {
    protected $user;
    protected $userType;

    function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository) {
        $this->user = $userRepository;
        $this->userType = $userTypeRepository;
        //$this->beforeFilter('auth', array('except' => array('index', 'show')));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->index(15);
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
            return Redirect::route('user.index')->with('message', 'User created!')->with('context', 'success');
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
        return Redirect::to('/user/' . $id . '/edit');
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);
        if (!$user) {
            return $this->message('No user found', $this->not_found_message);
        }
        $data = $user->userType()->get();

        $data['user_type_options'] = $this->userType->listOptions();
        return View::make('user.edit', $data)->with('user', $user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $result = $this->user->update($id, Input::all());
        if (!$result) {
            return Redirect::route('user.edit', array($id))->withInput()->withErrors($this->user->errors());
        } else {
            return Redirect::route('user.index')->with('message', 'User updated!')->with('context', 'success');
        }
	}


	/**
	 * Employ a soft delete by setting the user as inactive.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $result = $this->user->updateActive($id, false);
        if (!$result) {
            return Redirect::route('user.edit', array($id))->with('danger', 'Error deactivating user.!')->with('context', 'danger');
        } else {
            return Redirect::route('user.index')->with('message', 'User deactivated!')->with('context', 'success');
        }
	}


}
