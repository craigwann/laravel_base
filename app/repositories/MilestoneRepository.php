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
            'name' => 'required',
            'short' => 'required|max:256',
            'text' => 'required',
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

        $milestone = $this->buildPayload(new Milestone(), $input);
        $result = $milestone->save();
        if (!$result) {
            $this->setError($milestone->errors());
        }
        return $milestone->id;
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

    function buildPayload($payload, $input) {
        $payload->name = $input['name'];
        $payload->short = $input['short'];
        $payload->text = $input['text'];
        return $payload;
    }

    function index($paginate = 0) {
        if ($paginate) {
            return Milestone::paginate($paginate);
        }
        return Milestone::all();
    }
} 