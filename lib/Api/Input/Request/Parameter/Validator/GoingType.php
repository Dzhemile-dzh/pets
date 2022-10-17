<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/21/2016
 * Time: 5:45 PM
 */

namespace Api\Input\Request\Parameter\Validator;

class GoingType extends \Phalcon\Input\Request\Parameter\Validator
{
    private $goingKeys = [];
    const VALIDATOR_TITLE = 'enum';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->goingKeys) . ']';
    }

    /**
     * @param \Models\Selectors $selectors
     *
     * @throws \Exception
     */
    public function __construct(\Models\Selectors $selectors)
    {
        $this->goingKeys = $selectors->getGoingKeys();
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                if (!$this->validate($val)) {
                    return false;
                }
            }
            return true;
        }

        return in_array($value, $this->goingKeys);
    }
}
