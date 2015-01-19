<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 10:44 PM
 */

abstract class ValidatorBase {

    /**
     * The rules to decorate and then pass to the Validator.
     *
     * @var array
     */
    protected $rules = array();

    /**
     * Merge rules into the rules array.
     *
     * @param array $rules
     */
    function addRules(array $rules) {
        $this->rules = array_merge($this->rules, $rules);
    }

    /**
     * Pass our rules along to the validator.
     * If new rules are passed to this function, it will override our rules. This is to keep parameter compatibility with Validator::make.
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return mixed
     */
    function make(array $data, $rules = array(), $messages = array(), array $customAttributes = array()) {
        return \Validator::make($data, (!empty($rules)) ? $rules : $this->rules, $messages, $customAttributes);
    }
} 