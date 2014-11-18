<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:31 PM
 */

class UserRepository extends BaseRepository {
    protected $modelName = 'User';

    /**
     * Validate the password
     * @param $password
     * @param $passwordConfirmation
     * @return bool
     */
    function validatePassword($password, $passwordConfirmation) { {
        $validator = Validator::make(
            array(
                'password' => $password,
                'password_confirmation' => $passwordConfirmation
            ),
            array(
                'password' => 'required|between:4,16|alpha_num|confirmed',
                'password_confirmation' => 'required|between:4,16|alpha_num'
            )
        );
        if ($validator->fails()) {
            $this->setError($validator->errors());
            return false;
        }
        return true;
    }

    }
    function store($input) {
        //Handle password
        //Validate password before hashing
        if (!$this->validatePassword($input['password'], $input['password_confirmation'])) {
            return false;
        }
        $hash = Hash::make($input['password']);
        unset($input['password']);
        unset($input['password_confirmation']);

        $user = $this->buildPayload(new User(), $input);
        $user->password = $hash;
        $result = $user->save();
        if (!$result) {
            $this->setError($user->errors());
        }
        return $result;
    }

    function update($id, $input) {
        $hash = null;
        //Handle password
        //Validate password before hashing
        if (!empty($input['password'])) {
            if (!$this->validatePassword($input['password'], $input['password_confirmation'])) {
                return false;
            }
            $hash = Hash::make($input['password']);
            unset($input['password']);
            unset($input['password_confirmation']);
        }
        $user = $this->buildPayload(User::find($id), $input);
        if ($hash) {
            $user->password = $hash;
        }

        $result = $user->updateUniques();
        if (!$result) {
            $this->setError($user->errors());
        }
        return $result;
    }

    function updateActive($id, $active) {
        $user = User::find($id);
        $result = $user->updateUniques();
        if (!$result) {
            $this->setError($user->errors());
        }
        return $result;
    }

    function buildPayload($user, $input) {
        $user->user_first_name = $input['user_first_name'];
        $user->user_last_name = $input['user_last_name'];
        $user->user_username = $input['user_username'];
        $user->email = $input['email'];
        $user->user_type_id = $input['user_type_id'];
        $user->user_active = $input['user_active'];
        return $user;
    }

    function index($paginate = 0) {
        $user = DB::table('user')
            ->leftJoin('user_type', 'user.user_type_id', '=', 'user_type.user_type_id');
        if ($paginate) {
            return $user->paginate($paginate);
        }
        return $user->get();
    }
} 