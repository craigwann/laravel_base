<?php namespace Ironquest\Presenters;

use Ironquest\Milestone;
use McCool\LaravelAutoPresenter\BasePresenter;

class MilestonePresenter extends BasePresenter
{
    public function __construct(Milestone $milestone)
    {
        $this->resource = $milestone;
    }
}
