<?php namespace Ironquest\Presenters;

use Ironquest\Attunement;
use McCool\LaravelAutoPresenter\BasePresenter;

class AttunementPresenter extends BasePresenter
{
    public function __construct(Attunement $attunement)
    {
        $this->resource = $attunement;
    }
}
