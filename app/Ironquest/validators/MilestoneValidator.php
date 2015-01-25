<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 11:02 PM
 */

class MilestoneValidator extends ValidatorBase {

    /**
     * The rules to decorate and then pass to the Validator.
     *
     * @var array
     */
    protected $rules = array(
        'name' => 'required',
        'short' => 'required|max:256',
        'text' => 'required',
        'ability_short' => 'required|max:256',
     );

    /**
     * This record exists so we'll merge in some additional rules.
     *
     * @return $this
     */
    function existing() {
        return $this;
    }
} 