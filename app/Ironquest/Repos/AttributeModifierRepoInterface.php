<?php namespace Ironquest\Repos;

interface AttributeModifierRepoInterface extends BaseRepoInterface
{
    function listOptions($orderBy = 'id', $format = array('id' => 'name'));
    function listColumnOptions();
}
