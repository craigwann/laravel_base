<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\UserType;
use Ironquest\Repos\UserTypeRepoInterface;

class UserTypeRepo extends BaseRepo implements UserTypeRepoInterface
{
    use OptionableTrait;

    public function __construct(UserType $userType)
    {
        parent::__construct($userType);
    }
}
