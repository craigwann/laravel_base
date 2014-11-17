<?php

use LaravelBook\Ardent\Ardent;

class UserType extends Ardent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_type';
    public $timestamps = false;
    protected $primaryKey = 'user_type_id';

}
