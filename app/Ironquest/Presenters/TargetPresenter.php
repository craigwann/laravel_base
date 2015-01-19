<?php namespace Ironquest\Presenters;

use Ironquest\Target;
use McCool\LaravelAutoPresenter\BasePresenter;

class TargetPresenter extends BasePresenter
{
    public function __construct(Target $target)
    {
        $this->resource = $target;
    }
}
