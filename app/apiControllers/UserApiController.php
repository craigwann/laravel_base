<?php namespace api\v1;

use Chrisbjr\ApiGuard\ApiGuardController;
use Chrisbjr\ApiGuard\ApiKey;
use Chrisbjr\ApiGuard\Transformers\ApiKeyTransformer;

class UserApiController extends ApiGuardController {
    protected $user;
    protected $userType;

    function __construct(
        \UserService $userService,
        \UserTypeService $userTypeService
    ) {
        $this->user = $userService;
        $this->userType = $userTypeService;
        $this->setApiMethods();
        parent::__construct();
    }

    function setApiMethods() {
        $this->apiMethods = [
            'all' => [
                'keyAuthentication' => true,
                'level' => \Config::get('auth.userType.manager')
            ],
            'authenticate' => [
                'keyAuthentication' => false
            ]
        ];
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->index(15);
        return $this->response->withPaginator($users, new \UserTransformer());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = $this->user->find($id);
        if (!$user) {
            return $this->response->errorNotFound();
        }
        $data = $user->userType()->get();
        return $this->response->withItem($data, new \UserTransformer());
    }

    public function authenticate() {
        $byEmail = false;
        $rules = array(
            'username' => 'required_without:email',
            'email' => 'required_without:username|email',
            'password' => 'required|between:4,16|alpha_num'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return $this->response->errorWrongArgsValidator($validator);
        }

        $userData = array(
            'password' 	=> Input::get('password'),
            'active' => true
        );

        if(Input::json('username')) {
            $userData['username'] = Input::get('username');
        }
        if(Input::json('email')) {
            $userData['email'] = Input::get('email');
        }

        if (!Auth::attempt($userData)) {
            return $this->response->errorUnauthorized("Incorrect username/email or password.");
        }

        // We have validated this user
        // Assign an API key for this session
        $apiKey = ApiKey::where('user_id', '=', Auth::user()->id)->first();
        if (!isset($apiKey)) {
            $apiKey                = new ApiKey;
            $apiKey->user_id       = Auth::user()->id;
            $apiKey->key           = $apiKey->generateKey();
            $apiKey->level         = 5;
            $apiKey->ignore_limits = 0;
        } else {
            $apiKey->generateKey();
        }

        if (!$apiKey->save()) {
            return $this->response->errorInternalError("Failed to create an API key. Please try again.");
        }

        // We have an API key.. i guess we only need to return that.
        return $this->response->withItem($apiKey, new ApiKeyTransformer);
    }

    public function getUserDetails() {
        $user = $this->apiKey->user;

        return isset($user) ? $user : $this->response->errorNotFound();
    }

    public function deauthenticate() {
        if (empty($this->apiKey)) {
            return $this->response->errorUnauthorized("There is no such user to deauthenticate.");
        }

        $this->apiKey->delete();

        return $this->response->withArray([
            'ok' => [
                'code'      => 'SUCCESSFUL',
                'http_code' => 200,
                'message'   => 'User was successfuly deauthenticated'
            ]
        ]);
    }
}
