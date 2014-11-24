<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
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
}
