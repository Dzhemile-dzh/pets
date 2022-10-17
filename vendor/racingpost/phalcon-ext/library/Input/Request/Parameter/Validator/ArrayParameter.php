<?php

namespace Phalcon\Input\Request\Parameter\Validator;

use Phalcon\Input\Request\Parameter\Validator;

class ArrayParameter extends Validator
{
    private $itemValidator;
    const VALIDATOR_TITLE = 'array';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ', ' . $this->itemValidator->getValidatorTitle();
    }

    /**
     * ArrayParameter constructor.
     *
     * @param Validator|null $itemValidator
     */
    public function __construct(Validator $itemValidator = null)
    {
        $this->itemValidator = $itemValidator;
    }

    /**
     * @param $values
     *
     * @return bool
     */
    public function validate($values)
    {
        if (!is_array($values)) {
            return false;
        }
        if (!is_null($this->itemValidator)) {
            foreach ($values as $item) {
                if (!$this->itemValidator->validate($item)) {
                    return false;
                }
            }
        }
        return true;
    }
}
