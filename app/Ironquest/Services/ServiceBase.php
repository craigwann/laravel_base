<?php

/**
 * A base for service classes.
 */

namespace Ironquest\Services;

abstract class ServiceBase {
    protected $errors;

    /**
     * Get Errors
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Set errors.
     *
     * @param \Illuminate\Support\MessageBag $errors
     */
    public function setErrors(\Illuminate\Support\MessageBag $errors) {
        $this->errors = $errors;
    }
} 