<?php namespace Ironquest\Services;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 12/2/14
 * Time: 7:35 PM
 */

class AttributeModifier extends BaseService {
    use OptionableTrait;

    function __construct(\AttributeModifier $model) {
        $this->model = $model;
    }

} 