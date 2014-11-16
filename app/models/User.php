<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent implements UserInterface, RemindableInterface {
    public static $rules = array(
        'user_first_name'       => 'required',
        'user_last_name'        => 'required',
        'user_type_id'          => 'required',
        'password'              => 'required',
        'email' => 'required|email|unique:user',
        'user_username' => 'required|unique:user'
    );
    protected $guarded = array('id', 'password');

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
