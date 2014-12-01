<?php

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform($user)
    {
        //TODO CW: Transform this into a structured data array once database is finalized.
        if (($user instanceof Illuminate\Database\Eloquent\Collection)) {
            //Query Builder instances don't need this
            $user = $user->toArray();
        }
        return $user;
    }

}