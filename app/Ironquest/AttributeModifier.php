<?php namespace Ironquest;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\PresenterInterface;

class AttributeModifier extends Model implements PresenterInterface
{
    //protected $table = '';

    //protected $primaryKey = '';

    protected $fillable = [];

    public function getPresenter()
    {
        return 'Ironquest\Presenters\AttributeModifierPresenter';
    }
}
