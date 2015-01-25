<?php namespace Ironquest\Presenters;

use Ironquest\Range;
use McCool\LaravelAutoPresenter\BasePresenter;

class RangePresenter extends BasePresenter
{
    public function __construct(Range $range)
    {
        $this->resource = $range;
    }
}
