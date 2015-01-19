<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\Attunement;
use Ironquest\Repos\AttunementRepoInterface;

class AttunementRepo extends BaseRepo implements AttunementRepoInterface
{
    use OptionableTrait;

    public function __construct(Attunement $attunement)
    {
        parent::__construct($attunement);
    }
}
