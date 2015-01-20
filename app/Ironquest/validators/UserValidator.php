<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 11:02 PM
 */

class UserValidator extends ValidatorBase {

    /**
     * The rules to decorate and then pass to the Validator.
     *
     * @var array
     */
    protected $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'user_type_id' => 'required',
        'email' => 'required|email|unique:users',
        'username' => 'required|unique:users|alpha_dash',
        'pwssword' => 'required|between:4,16|alpha_num|confirmed',
        'username' => 'required|between:4,16|alpha_num'
     );

    /**
     * This record exists so we'll merge in some additional rules.
     *
     * @return $this
     */
    function existing() {
        $this->addRules(array(
            'password' => 'between:4,16|alpha_num|confirmed',
            'password_confirmation' => 'between:4,16|alpha_num',
            'email' => 'required|email',
            'username' => 'required|alpha_dash',
        ));
        return $this;
    }

    function validateLogin($data) {
        return $this->make($data, array(
            'username' => 'required',
            'password' => 'required|between:4,16|alpha_num'
        ));
    }
} 