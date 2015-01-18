<?php namespace Ironquest\Services;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 12/2/14
 * Time: 7:35 PM
 */

class Attunement extends BaseService {
    use OptionableTrait;

    function __construct(\Attunement $model) {
        $this->model = $model;
    }

} 