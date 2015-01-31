<?php namespace Ironquest\Validators;
/**
 * Created by PhpStorm.
 * User: craigwann1
 * Date: 1/17/15
 * Time: 11:02 PM
 */

use \Validator as Validator;
use Illuminate\Support\MessageBag;

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
        'targets' => 'required_with:rewards_ability',
        'ranges' => 'required_with:rewards_ability'
     );


    /**
     * Manual validation logic. Fired on validate and merged with validator messages.
     *
     * @param array $input
     * @return \Illuminate\Support\MessageBag
     */
    function manualValidation(array $input) {
        $messageBag = new MessageBag();
        if (empty($input['rewards_attribute'])) return $messageBag;

        foreach($input['attribute'] as $attribute) {
            if ($attribute == '') {
                $messageBag->add('attribute[]', 'required.');
            }
        }
        foreach($input['attribute_modifier'] as $attribute) {
            if ($attribute == '') {
                $messageBag->add('attribute_modifier[]', 'required.');
            }
        }
        return $messageBag;
    }
} 