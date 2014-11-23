<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent implements UserInterface, RemindableInterface {
    public static $rules = array(
        'first_name'       => 'required',
        'last_name'        => 'required',
        'user_type_id'          => 'required',
        'password'              => 'required',
        'email' => 'required|email|unique:users',
        'username' => 'required|unique:users|alpha_dash'
    );
    protected $guarded = array('id', 'password');

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function userType() {
        return $this->hasOne('UserType', 'id', 'user_type_id');
    }

    public function apiKey() {
        return $this->hasOne('Chrisbjr\ApiGuard\ApiKey', 'user_id', 'id');
    }

    public function isAdmin() {

    }



}
