<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\Milestone;
use Ironquest\Repos\MilestoneRepoInterface;

class MilestoneRepo extends BaseRepo implements MilestoneRepoInterface
{
    use PaginatableTrait;

    public function __construct(Milestone $milestone)
    {
        parent::__construct($milestone);
    }
}
