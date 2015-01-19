<?php namespace Ironquest\Presenters;

use Ironquest\AttributeModifier;
use McCool\LaravelAutoPresenter\BasePresenter;

class AttributeModifierPresenter extends BasePresenter
{
    public function __construct(AttributeModifier $attributeModifier)
    {
        $this->resource = $attributeModifier;
    }
}
