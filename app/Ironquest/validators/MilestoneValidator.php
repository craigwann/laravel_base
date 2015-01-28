<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 11:02 PM
 */

use \Validator as Validator;

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
        'ability_short' => 'required_with:rewards_ability|max:256',
        'targets' => 'required_with:rewards_ability|array',
        'ranges' => 'required_with:rewards_ability|array',
        'attunements' => 'array'
     );
} 