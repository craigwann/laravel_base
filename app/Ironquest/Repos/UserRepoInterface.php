<?php namespace Ironquest\Repos;

interface UserRepoInterface extends BaseRepoInterface
{
    function revive($id);
}
