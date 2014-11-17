<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:31 PM
 */

class UserRepository extends BaseRepository {
    protected $modelName = 'User';

    function store($input) {
        //Handle password
        //Validate password before hashing
        $validator = Validator::make(
            array(
                'password' => $input['password'],
                'password_confirmation' => $input['password_confirmation']
            ),
            array(
                'password' => 'required|between:4,8|alpha_num|confirmed',
                'password_confirmation' => 'required|between:4,8|alpha_num'
            )
        );
        if ($validator->fails()) {
            $this->setError($validator->errors());
            return false;
        }

        $hash = Hash::make($input['password']);
        unset($input['password']);
        unset($input['password_confirmation']);

        $user = new User();
        $user->user_first_name = $input['user_first_name'];
        $user->user_last_name = $input['user_last_name'];
        $user->user_username = $input['user_username'];
        $user->email = $input['email'];
        $user->user_type_id = $input['user_type_id'];
        $user->user_type_id = $input['user_active'];
        $user->password = $hash;
        $result = $user->save();
        if (!$result) {
            $this->setError($user->errors());
        }
        return $result;
    }

    function index() {
        return DB::table('user')
            ->leftJoin('user_type', 'user.user_type_id', '=', 'user_type.user_type_id')
            ->get();
    }
} 