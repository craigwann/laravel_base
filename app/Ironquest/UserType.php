<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use McCool\LaravelAutoPresenter\PresenterInterface;

class UserType extends Model implements PresenterInterface
{
    use SoftDeletingTrait;

    //protected $table = '';

    //protected $primaryKey = '';

    protected $fillable = [];

    public function getPresenter()
    {
        return 'Ironquest\Presenters\UserTypePresenter';
    }
}