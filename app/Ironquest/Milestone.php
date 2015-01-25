<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Milestone extends Model implements PresenterInterface
{
    //protected $table = '';

    //protected $primaryKey = '';

    protected $fillable = [];

    protected $guarded = array('id');

    public function ability() {
        return $this->hasOne('Ironquest\Ability', 'id', 'ability_id');
    }

    public function getPresenter()
    {
        return 'Ironquest\Presenters\MilestonePresenter';
    }
}
