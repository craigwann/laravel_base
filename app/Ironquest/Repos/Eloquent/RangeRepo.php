<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\Range;
use Ironquest\Repos\RangeRepoInterface;

class RangeRepo extends BaseRepo implements RangeRepoInterface
{
    use OptionableTrait;

    public function __construct(Range $range)
    {
        parent::__construct($range);
    }
}
