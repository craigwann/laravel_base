<?php namespace Ironquest\Presenters;

use Ironquest\ApiKey;
use McCool\LaravelAutoPresenter\BasePresenter;

class ApiKeyPresenter extends BasePresenter
{
    public function __construct(ApiKey $apiKey)
    {
        $this->resource = $apiKey;
    }
}
