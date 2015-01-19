<?php namespace Ironquest\Repos\Eloquent;

use Ironquest\AttributeModifier;
use Ironquest\Repos\AttributeModifierRepoInterface;

class AttributeModifierRepo extends BaseRepo implements AttributeModifierRepoInterface
{
    use OptionableTrait;

    public function __construct(AttributeModifier $attributeModifier)
    {
        parent::__construct($attributeModifier);
    }
}
