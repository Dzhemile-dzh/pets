<?php

namespace Api\Input\Request\Parameter\Validator;

use Api\Exception\ValidationError;

class Surface extends \Phalcon\Input\Request\Parameter\Validator
{
    /**
     * @var
     */
    private $surfaces = [];
    const VALIDATOR_TITLE = 'enum';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->surfaces) . ']';
    }

    /**
     * @param \Models\Selectors $selectors
     */
    public function __construct(\Models\Selectors $selectors)
    {
        $this->surfaces = $selectors->getSurfaces();
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value) && in_array($value, $this->surfaces);
    }
}
