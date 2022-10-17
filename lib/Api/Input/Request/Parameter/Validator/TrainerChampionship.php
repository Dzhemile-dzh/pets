<?php
namespace Api\Input\Request\Parameter\Validator;

class TrainerChampionship extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'enum [trainer]';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return $value === 'trainer';
    }
}
