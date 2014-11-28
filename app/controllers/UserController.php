<?php

class UserController extends \BaseController {
    protected $user;
    protected $userType;
    protected $apiKey;

    function __construct(UserRepository $userRepository, UserTypeRepository $userTypeRepository, ApiKeyRepository $apiKeyRepository) {
        $this->user = $userRepository;
        $this->userType = $userTypeRepository;
        $this->apiKey = $apiKeyRepository;

        $this->beforeFilter('access:' . Config::get('auth.userType.manager'), array('except' => array('login', 'processLogin')));
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
        return View::make('user.create', array('userTypeOptions' => $this->userType->listOptions()));
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
            return Redirect::route('users.create')->withInput()->withErrors($this->user->errors());
        } else {
            return Redirect::route('users.edit', array($result))->with('message', 'User created!')->with('context', 'success');
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
		$user = $this->user->withTrashed()->find($id);
        if (!$user) {
            return $this->message('No user found', $this->not_found_message);
        }
        $data = $user->with('userType')->first();

        $data['userTypeOptions'] = $this->userType->listOptions();

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
            return Redirect::route('users.edit', array($id))->withInput()->withErrors($this->user->errors());
        } else {
            return Redirect::route('users.edit', array($id))->with('message', 'User updated!')->with('context', 'success');
        }
	}

	public function destroy($id)
	{
        $result = $this->user->destroy($id);
        if (!$result) {
            return Redirect::route('users.edit', array($id))->with('danger', 'Error deactivating user!')->with('context', 'danger');
        } else {
            return Redirect::route('users.edit', array($id))->with('message', 'User deactivated!')->with('context', 'success');
        }
	}

    public function revive($id)
    {
        $result = $this->user->revive($id);
        if (!$result) {
            var_dump($this->user->errors());
            exit;
            return Redirect::route('users.edit', array($id))->with('danger', 'Error reviving user!')->with('context', 'danger');
        } else {
            return Redirect::route('users.edit', array($id))->with('message', 'User revived!')->with('context', 'success');
        }
    }

    function login() {
        return View::make('user.login');
    }

    function processLogin() {
        $rules = array(
            'username' => 'required',
            'password' => 'required|between:4,16|alpha_num'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }

        $userData = array(
            'password' 	=> Input::get('password')
        );

        if (str_contains(Input::get('username'), '@') &&
            str_contains(Input::get('username'), '.')) {
            //Logging in with email instead of username
            $userData['email'] = Input::get('username');
        } else {
            $userData['username'] = Input::get('username');
        }

        if (Auth::attempt($userData)) {
            return Redirect::route('dashboard')->with('message', 'Welcome, ' . Auth::user()->username . '!')->with('context', 'success');
        } else {
            return Redirect::route('login')->with('message', 'Incorrect username or password.')->with('context', 'danger');
        }
    }

    function logout() {
        Auth::logout();
        return Redirect::route('login')->with('message', 'Logged out.')->with('context', 'success');
    }
}
