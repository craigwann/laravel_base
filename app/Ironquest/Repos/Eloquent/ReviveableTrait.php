<?php
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/19/15
 * Time: 7:59 PM
 */

namespace Ironquest\Repos\Eloquent;


class ReviveableTrait {

    /**
     * Undelete a record from a soft deleting model.
     *
     * @param $id
     * @return mixed
     */
    function revive($id) {
        $user = $this->model->withTrashed()->find($id);
        return $user->restore();
    }
} 