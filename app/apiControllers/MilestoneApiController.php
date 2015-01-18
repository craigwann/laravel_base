<?php namespace api\v1;

use Chrisbjr\ApiGuard\ApiGuardController;

class MilestoneApiController extends ApiGuardController {
    protected $milestone;

    function __construct(
        \MilestoneService $milestoneService
    )
    {
        $this->milestone = $milestoneService;
        parent::__construct();
    }

    function setApiMethods() {
        $this->$apiMethods = [
            'all' => [
                'keyAuthentication' => true,
                'level' => \Config::get('auth.userType.player')
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
		$milestones = $this->milestone->index(15);
        return $this->response->withPaginator($milestones, new \MilestoneTransformer());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $milestone = $this->milestone->find($id);
        if (!$milestone) {
            return $this->response->errorNotFound();
        }
        return $this->response->withItem($milestone, new \MilestoneTransformer());
    }
}
