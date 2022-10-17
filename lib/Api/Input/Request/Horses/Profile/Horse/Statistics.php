<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Profile\Horse;

use Api\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Statistics extends \Api\Input\Request\HorsesRequest
{
    use \Api\Input\Request\Method\GetRaceTypeCodes;

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'horseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceType',
            new Validator\RaceType(
                $this->getSelectors()
            )
        );
    }
}
