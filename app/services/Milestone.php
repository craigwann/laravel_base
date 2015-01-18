<?php namespace Ironquest\Services;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:31 PM
 */

use Ironquest\Validators\MilestoneValidator;

class Milestone extends BaseService {

    function __construct(\Milestone $model, MilestoneValidator $validator) {
        $this->model = $model;
        $this->validator = $validator;
    }

    function store($input) {
        $validator = $this->validator->make($input);
        if ($validator->fails()) {
            $this->setError($validator->messages());
            return false;
        }
        $milestone = $this->buildPayload(new \Milestone(), $input);
        $result = $milestone->save();
        if (!$result) {
            $this->setError($milestone->errors());
        }
        return $milestone->id;
    }

    function buildPayload($payload, $input) {
        $payload->name = $input['name'];
        $payload->short = $input['short'];
        $payload->text = $input['text'];
        return $payload;
    }

    function index($paginate = 0) {
        if ($paginate) {
            return Milestone::paginate($paginate);
        }
        return Milestone::all();
    }
} 