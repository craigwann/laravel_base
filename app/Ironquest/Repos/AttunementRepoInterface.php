<?php namespace Ironquest\Repos;

interface AttunementRepoInterface extends BaseRepoInterface
{
    function listOptions($orderBy = 'id', $format = array('id' => 'name'));
    function listColumnOptions();
}
