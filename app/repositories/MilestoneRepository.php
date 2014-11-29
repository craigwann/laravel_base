<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/15/14
 * Time: 8:31 PM
 */

class MilestoneRepository extends BaseRepository {
    protected $modelName = 'Milestone';

    function validate($input, $extraRules = array()) {
        $rules = array_merge(array(
            'first_name' => 'required',
            'last_name' => 'required',
            'user_type_id' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|alpha_dash',
            'pwssword' => 'required|between:4,16|alpha_num|confirmed',
            'username' => 'required|between:4,16|alpha_num'
        ), $extraRules);

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $this->setError($validator->errors());
            return false;
        }
        return true;
    }

    function store($input) {
        if (!$this->validate($input)) {
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
        return $user->id;
    }

    function update($id, $input) {
        $hash = null;
        if (!$this->validate($input,
            array(
                'password' => 'between:4,16|alpha_num|confirmed',
                'password_confirmation' => 'between:4,16|alpha_num',
                'email' => 'required|email',
                'username' => 'required|alpha_dash',
            )
        )) {
            return false;
        }
        if (!empty($input['password'])) {
            $hash = Hash::make($input['password']);
            unset($input['password']);
            unset($input['password_confirmation']);
        }
        $user = $this->buildPayload(User::find($id), $input);
        if ($hash) {
            $user->password = $hash;
        }

        $result = $user->save();
        if (!$result) {
            $this->setError($user->errors());
        }
        return $result;
    }

    function destroy($id) {
        $user = User::find($id);
        $result = $user->delete();
        if (!$result) {
            $this->setError($user->errors());
            return $result;
        }
        $apiKey = Chrisbjr\ApiGuard\ApiKey::where('user_id', '=', $id)->first();
        if($apiKey) {
            $api_key_result = $apiKey->delete();
            if (!$api_key_result) {
                $this->setError($apiKey->errors());
                return $api_key_result;
            }
        }
        return $result;
    }

    function revive($id) {
        $user = User::withTrashed()->find($id);
        $result = $user->restore();
        if (!$result) {
            $this->setError($user->errors());
            return $result;
        }
        $apiKey = Chrisbjr\ApiGuard\ApiKey::where('user_id', '=', $id)->first();
        if($apiKey) {
            $api_key_result = $apiKey->restore();
            if (!$api_key_result) {
                $this->setError($apiKey->errors());
                return $api_key_result;
            }
        }
        return $result;
    }

    function buildPayload($user, $input) {
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->username = $input['username'];
        $user->email = $input['email'];
        $user->user_type_id = $input['user_type_id'];
        return $user;
    }

    function index($paginate = 0) {
        $user = DB::table('users')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.username', 'users.deleted_at', 'user_types.name as user_type_name', 'user_types.id as user_type_id')
            ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id');
        if ($paginate) {
            return $user->paginate($paginate);
        }
        return $user->get();
    }
} 