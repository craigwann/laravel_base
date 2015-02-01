<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Milestone extends Model implements PresenterInterface
{
    //protected $table = '';

    //protected $primaryKey = '';

    protected $fillable = [];

    protected $guarded = array('id');

    public function getPresenter()
    {
        return 'Ironquest\Presenters\MilestonePresenter';
    }
}
