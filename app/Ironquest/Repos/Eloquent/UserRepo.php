<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\User;
use Ironquest\Repos\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
