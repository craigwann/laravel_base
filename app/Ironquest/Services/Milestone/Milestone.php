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
use Ironquest\Repos\AbilityRepoInterface as AbilityRepo;
use Ironquest\Repos\TargetRepoInterface as TargetRepo;
use Ironquest\Repos\RangeRepoInterface as RangeRepo;
use Ironquest\Repos\AttunementRepoInterface as AttunementRepo;
use Ironquest\Repos\AttributeModifierRepoInterface as AttributeModifierRepo;

class Milestone extends EntityBase {

    function __construct(
        validator $validator,
        repository $repository,
        AbilityRepo $abilityRepo,
        TargetRepo $targetRepo,
        RangeRepo $rangeRepo,
        AttunementRepo $attunementRepo,
        AttributeModifierRepo $attributeModifierRepo
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->abilityRepo = $abilityRepo;
        $this->targetRepo = $targetRepo;
        $this->rangeRepo = $rangeRepo;
        $this->attunementRepo = $attunementRepo;
        $this->attributeModifierRepo = $this->attributeModifierRepo;
    }

    function getOptionData() {
        return array(
            'attributeModifierOptions' => App::make('Ironquest\Repos\AttributeModifierRepoInterface')->listColumnOptions(),
            'targetOptions' => App::make('Ironquest\Repos\TargetRepoInterface')->listOptions(),
            'attunementOptions' => App::make('Ironquest\Repos\AttunementRepoInterface')->listOptions(),
            'rangeOptions' => App::make('Ironquest\Repos\RangeRepoInterface')->listOptions()
        );
    }

    /**
     * Create
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        if (!$this->validator->validate($data)) {
            $this->setErrors($this->validator->messages());
            return false;
        }
        try {
            $milestone = $this->repository->create(array(
                'name' => $data['name'],
                'short' => $data['short'],
                'text' => $data['text'],
            ));

            if (!empty($data['rewards_ability'])) {
                $ability = $this->abilityRepo->create(array(
                    'short' => $data['ability_short']
                ));
                $milestone->ability()->save($ability);
                foreach($data['targets'] as $target) {
                    $target = $this->targetsRepo->create();
                    $ability->targets()
                }
            }

            $this->abilityRepo->create(array(
                'name' => $data['name'],
                'short' => $data['short'],
                'text' => $data['text'],
            ));
        } catch (Exception $e) {
            Session::flash('message', array('message' => $this->errorFlashMessage, 'context' => 'danger'));
            return false;
        }

        Session::flash('message', array('message' => ucfirst($this->name) . ' created!', 'context' => 'success'));
        return $this->repository->getLastId();
    }

    /**
     * Update
     *
     * @param array $data
     * @return boolean
     */
    public function update(array $data)
    {
        if (!$this->validator->validate($data)) {
            $this->setErrors($this->validator->messages());
            return false;
        }

        try {
            $this->repository->update($data);
        } catch (Exception $e) {
            Session::flash('message', array('message' => $this->errorFlashMessage, 'context' => 'danger'));
            return false;
        }

        Session::flash('message', array('message' => ucfirst($this->name) . ' updated!', 'context' => 'success'));
        return $this->repository->getLastId();
    }
} 