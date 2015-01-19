<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 11:13 PM
 */

interface ValidatorInterface {
    function addRules(array $rules);
    function make(array $data, $rules = array(), $messages = array(), array $customAttributes = array());
    function existing();
} 