<?php namespace Ironquest\Services\Milestone;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 1/25/15
 * Time: 5:07 PM
 */

use \App as App;
use Ironquest\Services\EntityBase;
use Ironquest\Validators\MilestoneValidator as validator;
use Ironquest\Repos\MilestoneRepoInterface as repository;

class Milestone extends EntityBase {

    /**
     * @param validator $validator
     * @param repository $repository
     */
    function __construct(
        validator $validator,
        repository $repository
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    function getOptionData() {
        return array(
            'attributeModifierOptions' => App::make('Ironquest\Repos\AttributeModifierRepoInterface')->listColumnOptions(),
            'targetOptions' => App::make('Ironquest\Repos\TargetRepoInterface')->listOptions(),
            'attunementOptions' => App::make('Ironquest\Repos\AttunementRepoInterface')->listOptions(),
            'rangeOptions' => App::make('Ironquest\Repos\RangeRepoInterface')->listOptions()
        );
    }
} 