<?php
namespace Api\Input\Request\Horses\HeadToHead;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Index
 *
 * @package Api\Input\Request\Horses\HeadToHead
 *
 */
class Index extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'firstHorseUid',
            new StandardValidator\IntegerId()
        );
        $this->addCast('firstHorseUid', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'secondHorseUid',
            new StandardValidator\IntegerId()
        );
        $this->addCast('secondHorseUid', new Cast\DecimalInteger());
    }
}
