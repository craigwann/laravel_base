<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Ability extends Model implements PresenterInterface
{
    //protected $table = '';

    //protected $primaryKey = '';

    protected $guarded = [];

    public function milestone() {
        return $this->hasOne('Ironquest\Milestone', 'id', 'ability_id');
    }

    public function ranges()
    {
        return $this->belongsToMany('Range', 'ability_has_ranges', 'ability_id', 'ranges_id');
    }

    public function targets()
    {
        return $this->belongsToMany('Target', 'ability_has_targets', 'ability_id', 'targets_id');
    }

    public function attunements()
    {
        return $this->belongsToMany('Attunements', 'ability_has_attunements', 'ability_id', 'attunements_id');
    }

    public function getPresenter()
    {
        return 'Ironquest\Presenters\AbilityPresenter';
    }
}
