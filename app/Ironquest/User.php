<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use McCool\LaravelAutoPresenter\PresenterInterface;

class User extends Model implements UserInterface, RemindableInterface, PresenterInterface
{
    protected $guarded = array('id', 'password');

    use UserTrait, RemindableTrait, SoftDeletingTrait;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function userType()
    {
        return $this->hasOne('Ironquest\UserType', 'id', 'user_type_id');
    }

    public function getPresenter()
    {
        return 'Ironquest\Presenters\UserPresenter';
    }
}