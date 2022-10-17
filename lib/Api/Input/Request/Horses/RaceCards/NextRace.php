<?php
/**
 *
 */
namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class NextRace extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'isExcludePTP',
            new StandardValidator\Boolean(),
            false,
            false
        );
        $this->addCast('isExcludePTP', new Cast\Boolean());
    }
}
