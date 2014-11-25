<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:32 PM
 */

use \Chrisbjr\ApiGuard;

class ApiKeyRepository extends BaseRepository {
    protected $modelName = 'ApiKey';

    /**
     * List as options for display. Result can be dropped as is into a form select.
     * Keep the levels in sync with the UserType levels for now.
     */
    function listOptions() {
        $data = UserType::where('active', '=', true)->orderBy('level')->get()->toArray();
        $result = [];
        foreach($data as $type) {
            $result[$type['level']] = $type['name'];
        }
        return $result;
    }
} 