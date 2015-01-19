<?php namespace Ironquest\Controllers;

class DirectoryController extends BaseController {

	/**
	 * Display the specified resource.
	 * GET /directory/
	 *
	 * @return Response
	 */
	public function show()
	{
        return \View::make('directory.show');
	}

}