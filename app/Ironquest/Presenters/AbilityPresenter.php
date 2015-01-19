<?php namespace Ironquest\Presenters;

use Ironquest\Ability;
use McCool\LaravelAutoPresenter\BasePresenter;

class AbilityPresenter extends BasePresenter
{
    public function __construct(Ability $ability)
    {
        $this->resource = $ability;
    }
}
