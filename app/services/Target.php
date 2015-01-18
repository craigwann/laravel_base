<?php namespace Ironquest\Services;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 12/2/14
 * Time: 7:35 PM
 */

class Target extends BaseService {
    use OptionableTrait;

    function __construct(\Target $model) {
        $this->model = $model;
    }
} 