<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\Milestone;
use Ironquest\Repos\MilestoneRepoInterface;

class MilestoneRepo extends BaseRepo implements MilestoneRepoInterface
{
    public function __construct(Milestone $milestone)
    {
        parent::__construct($milestone);
    }
}
