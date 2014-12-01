<?php

use League\Fractal\TransformerAbstract;

class MilestoneTransformer extends TransformerAbstract
{

    public function transform($milestone)
    {
        //TODO CW: Transform this into a structured data array once database is finalized.
        if (($milestone instanceof Illuminate\Database\Eloquent\Collection) ||
            ($milestone instanceof Milestone)) {
            //Query Builder instances don't need this
            $milestone = $milestone->toArray();
        }
        return $milestone;
    }

}