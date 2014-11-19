<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:32 PM
 */

class UserTypeRepository extends BaseRepository {
    protected $modelName = 'UserType';

    /**
     * List as options for display. Result can be dropped as is into a form select.
     */
    function listOptions() {
        $data = UserType::where('active', '=', true)->get()->toArray();
        $result = [];
        foreach($data as $type) {
            $result[$type['id']] = $type['name'];
        }
        return $result;
    }
} 