<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/27/14
 * Time: 9:46 PM
 */

class DirectoryController extends BaseController {

    public function show()
    {
        return View::make('directory.show');
    }

} 