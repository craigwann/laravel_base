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

    /**
     * Create
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        $validator = $this->validator->make($data);
        $errors = $this->validator->addAttributeValidationErrors($data, $validator);
        if ($errors->count()) {
            $this->setErrors($errors);
            return false;
        }

        try {
            $this->repository->create($data);
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
        $validator = $this->validator->existing()->make($data);
        $errors = $this->validator->addAttributeValidationErrors($data, $validator);
        if ($errors->count()) {
            $this->setErrors($errors);
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