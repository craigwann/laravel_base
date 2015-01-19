<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\Ability;
use Ironquest\Repos\AbilityRepoInterface;

class AbilityRepo extends BaseRepo implements AbilityRepoInterface
{
    public function __construct(Ability $ability)
    {
        parent::__construct($ability);
    }
}
