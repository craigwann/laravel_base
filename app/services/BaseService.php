<?php namespace Ironquest\Services;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 9:46 PM
 */

abstract class BaseService {
    protected $model;
    protected $errors;
    protected $validatorName;

    function setError($message) {
        $this->errors = $message;
        return false;
    }

    function errors() {
        return $this->errors;
    }
} 