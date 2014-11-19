<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 9:46 PM
 */

abstract class BaseRepository {
    protected $modelName;
    protected $errors;

    function setError($message) {
        $this->errors = $message;
        return false;
    }

    function errors() {
        return $this->errors;
    }

    /**
     * Method overload to model.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments) {
        return call_user_func_array(array($this->modelName, $name), $arguments);
    }
} 