<?php namespace Ironquest\Controllers;

class DashboardController extends BaseController {

    /**
     * Display the specified resource.
     * GET /directory/
     *
     * @return Response
     */
    public function show()
    {
        return \View::make('dashboard.show');
    }

}