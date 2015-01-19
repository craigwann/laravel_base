<?php namespace Ironquest\Presenters;

use Ironquest\UserType;
use McCool\LaravelAutoPresenter\BasePresenter;

class UserTypePresenter extends BasePresenter
{
    public function __construct(UserType $userType)
    {
        $this->resource = $userType;
    }
}
