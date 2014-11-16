<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:31 PM
 */

class UserRepository extends BaseRepository {

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
                return $validator->errors();
            }

            $hash = Hash::make($input['password']);
            unset($input['password']);
            unset($input['password_confirmation']);

            $user = new User();
            $user->user_first_name = $input['user_first_name'];
            $user->user_last_name = $input['user_last_name'];
            $user->user_email = $input['user_email'];
            $user->user_type_id = $input['user_type_id'];
            $user->user_type_id = $input['user_active'];
            $user->password = $hash;
            $result = $user->save();
            if (!$result) {
                return $this->setError($user->errors());
            }
        }
} 