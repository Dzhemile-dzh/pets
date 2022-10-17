<?php

namespace Api\Input\Request\Parameter\Validator;

class RaceType extends \Phalcon\Input\Request\Parameter\Validator
{
    private $raceTypeKeys = [];
    const VALIDATOR_TITLE = 'enum';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->raceTypeKeys) . ']';
    }

    /**
     * @param \Models\Selectors $selectors
     */
    public function __construct(\Models\Selectors $selectors)
    {
        $this->raceTypeKeys = $selectors->getRaceTypeKeys();
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value) && in_array($value, $this->raceTypeKeys);
    }
}
