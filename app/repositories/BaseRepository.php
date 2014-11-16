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
     * List as options for display. Result can be dropped as is into a form select.
     */
    function listOptions() {
        $data = UserType::where('user_type_active', '=', true)->get()->toArray();

        $result = [];
        foreach($data as $type) {
            $result[$type['user_type_id']] = $type['user_type_name'];
        }
        return $result;
    }

    /**
     * Method overload to model.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments) {
        return call_user_func_array(array($this->modelName . '::', $name), $arguments);
    }
} 