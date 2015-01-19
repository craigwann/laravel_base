<?php namespace Ironquest\Presenters;

use Ironquest\User;
use McCool\LaravelAutoPresenter\BasePresenter;

class UserPresenter extends BasePresenter
{
    public function __construct(User $user)
    {
        $this->resource = $user;
    }
}
