<?php

/**
 * A base for service classes.
 */

namespace Ironquest\Services;

abstract class ServiceBase {
    /**
     * Get Errors
     *
     * @return Illuminate\Support\MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Set errors.
     *
     * @param Illuminate\Support\MessageBag $errors
     */
    public function setErrors(Illuminate\Support\MessageBag $errors) {
        $this->setErrors($errors);
    }

    /**
     * Get the message.
     *
     * @return mixed
     */
    public function message() {
        return $this->message;
    }

    /**
     * Set a message.
     * 
     * @param $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

} 