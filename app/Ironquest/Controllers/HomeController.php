<?php namespace Ironquest\Controllers;

use Ironquest\Repos\Eloquent\HomeRepo as Home;

class HomeController extends BaseController {

	/**
	 * View content.
	 * GET /home/
	 *
	 * @return Response
	 */
	public function show()
	{
        return View::make('home');
	}

}