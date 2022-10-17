<?php
namespace Api\Input\Request\Parameter\Validator;

class Championship extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'enum';
    private $championships = [
        'trainer',
        'jockey',
        'owner'
    ];

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->championships) . ']';
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value) && in_array($value, $this->championships);
    }
}
