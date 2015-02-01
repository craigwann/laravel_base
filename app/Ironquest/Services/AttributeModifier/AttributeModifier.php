<?php namespace Ironquest\Services\AttributeModifier;
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 1/25/15
 * Time: 5:07 PM
 */

use Ironquest\Repos\Repo as Repo;
use Ironquest\Validators\AttributeModifierValidator as validator;
use Ironquest\Repos\AttributeModifierRepoInterface as repository;

class AttributeModifier {

    function __construct(
        validator $validator,
        repository $repository
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
     * Because I would rather the attribute data be in as single row per input.
     * I should probably move this to the font end at some point.
     *
     * @param array $data
     * @return array
     */
    function tranformInput(array $data) {
        if (empty($data['id'])) return $data;
        $new = array();
        $i = 0;
        foreach ($data['id'] as $id) {
            $new[$i]['id'] = $id;
            $i++;
        }
        $i = 0;
        foreach ($data['mod'] as $mod) {
            $new[$i]['mod'] = $mod;
            $i++;
        }
        return $new;
    }

} 