<?php namespace Ironquest\Controllers;

class BaseController extends Controller {

    protected $not_found_message = "You must have failed your perception check.";

    function __construct() {
        $this->beforeFilter(function()
        {
            \Event::fire('clockwork.controller.start');
        });

        $this->afterFilter(function()
        {
            \Event::fire('clockwork.controller.end');
        });
    }
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

    function message($header, $message) {
        return \View::make('message', array('header' => $header, 'message' => $message));
    }

}
