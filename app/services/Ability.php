<?php namespace Ironquest\Services;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 12/2/14
 * Time: 7:35 PM
 */

class Ability extends BaseService {

    function __construct(\Ability $model) {
        $this->model = $model;
    }
} 