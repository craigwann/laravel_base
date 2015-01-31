<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Target extends Model implements PresenterInterface
{
    //protected $table = '';

    //protected $primaryKey = '';

    protected $fillable = [];

    public function getPresenter()
    {
        return 'Ironquest\Presenters\TargetPresenter';
    }

    public function target() {
        return $this->belongsToMany('Ironquest\Target', 'ability_has_targets');
    }
}
