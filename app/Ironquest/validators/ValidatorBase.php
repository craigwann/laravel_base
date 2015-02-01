<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 10:44 PM
 */

use \Validator as Validator;
use Illuminate\Support\MessageBag;

abstract class ValidatorBase {

    /**
     * The rules to decorate and then pass to the Validator.
     *
     * @var array
     */
    protected $rules = array();

    /**
     * Validator errors
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $messages = array();

    /**
     * Merge rules into the rules array.
     *
     * @param array $rules
     */
    function addRules(array $rules) {
        $this->rules = array_merge($this->rules, $rules);
    }

    /**
     * This record exists so we'll merge in some additional rules.
     *
     * @return $this
     */
    function existing() {
        return $this;
    }

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     *
     * @return bool
     */
    function validate(array $data, $rules = array(), $messages = array(), array $customAttributes = array()) {
        $validator = $this->make($data, $rules, $messages, $customAttributes);

        //Bootforms doesn't play nicely with array type validation dot notation
        $validatorMessages = array();
        foreach($validator->messages()->toArray() as $field => $message) {
            $validatorMessages[str_replace('.', '[', $field) . ']'] = $message;
        };

        $messages = $this->mergeMessageBags(new MessageBag($validatorMessages), $this->manualValidation($data));
        if ($messages->count()) {
            $this->setMessages($messages);
            return false;
        }
        return true;
    }

    /**
     * Manual validation logic. Fired on validate and merged with validator messages.
     *
     * @param array $data
     * @return \Illuminate\Support\MessageBag
     */
    function manualValidation(array $data) {
        return new MessageBag();
    }

    /**
     * Pass our rules along to the validator.
     * If new rules are passed to this function, it will override our rules. This is to keep parameter compatibility with Validator::make.
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return mixed
     */
    function make(array $data, $rules = array(), $messages = array(), array $customAttributes = array()) {
        return Validator::make(
            $data,
            (!empty($rules)) ? $rules : $this->rules,
            array_merge($messages, $this->messages),
            $customAttributes
        );
    }

    /**
     * Set messages.
     *
     * @param \Illuminate\Support\MessageBag
     */
    function setMessages(MessageBag $bag) {
        $this->messages = $bag;
    }

    function messages() {
        return $this->messages;
    }

    function mergeMessageBags(MessageBag $bag, MessageBag $bag2) {
        return new MessageBag(array_merge_recursive($bag->toArray(), $bag2->toArray()));
    }
} 