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
        'milestone.name' => 'required',
        'milestone.short' => 'required|max:256',
        'milestone.text' => 'required',
        'ability.short' => 'required_with:rewards_ability|max:256',
        'targets' => 'required_with:rewards_ability',
        'ranges' => 'required_with:rewards_ability',
        'attribute_modifier[]id' => 'required_with:rewards_attribute',
        'attribute_modifier[]mod' => 'required_with:rewards_attribute|numeric'
     );

    protected $messges = array(
        'milestone.name.required' => 'test'
    );


    /**
     * Manual validation logic. Fired on validate and merged with validator messages.
     *
     * @param array $input
     * @return \Illuminate\Support\MessageBag
     */
    function manualValidation(array $input) {
        $messageBag = new MessageBag();
        if ((empty($input['rewards_ability'])) || !count($input['attribute_modifier'])) return $messageBag;

        foreach($input['attribute_modifier'] as $attribute_modifier) {
            if ($attribute_modifier['id'] == '') {
                $messageBag->add('attribute_modifier[]id', 'required.');
            }
            if ($attribute_modifier['mod'] == '') {
                $messageBag->add('attribute_modifier[]mod', 'required.');
            }
        }
        return $messageBag;
    }

} 