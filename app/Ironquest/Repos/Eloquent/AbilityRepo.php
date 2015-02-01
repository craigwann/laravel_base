<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\Ability;
use Ironquest\Repos\AbilityRepoInterface;

class AbilityRepo extends BaseRepo implements AbilityRepoInterface
{
    public function __construct(Ability $ability)
    {
        parent::__construct($ability);
    }

    public function createWithRelationships(array $input) {
        $ability = $this->create($input['ability']);
        $ability->targets->attach($input['targets']);
        $ability->ranges->attach($input['ranges']);
        $ability->attunements->attach($input['attunements']);
        $milestone = Repo::build('milestone')->getNew($input['milestones']);
        $ability->milestone()->save($milestone);
        return $ability;
    }
}
