<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/27/14
 * Time: 9:46 PM
 */

class DashboardController extends BaseController {

    public function show()
    {
        return View::make('dashboard.show');
    }

} 