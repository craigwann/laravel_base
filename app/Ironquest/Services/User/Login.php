<?php namespace Ironquest\Services\User;

use Ironquest\Validators\UserValidator as Validator;

/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/19/15
 * Time: 10:25 PM
 */

class Login {
    protected $errors;

    function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    /**
     * Attempt to log in.
     *
     * @param array $input
     * @return bool
     */
    function attempt(array $input) {
        $validator = $this->validator->validateLogin($input);
        if ($validator->fails()) {
            $this->setErrors($validator);
            return false;
        }
        if (!\Auth::attempt($this->buildUserData($input))) {
            $this->setErrors($validator);
            return false;
        };
        return true;
    }

    /**
     * Build auth payload, by either username or email.
     *
     * @param array $input
     * @return array
     */
    private function buildUserData(array $input) {
        $userData = array(
            'password' 	=> $input['password']
        );

        if (str_contains($input['username'], '@') &&
            str_contains($input['username'], '.')) {
            //Logging in with email instead of username
            $userData['email'] = $input['username'];
        } else {
            $userData['username'] = $input['username'];
        }
        return $userData;
    }

    private function setErrors($errors) {
        $this->errors = $errors;
    }

    function errors() {
        return $this->errors;
    }

    function logout() {
        \Auth::logout();
    }

} 