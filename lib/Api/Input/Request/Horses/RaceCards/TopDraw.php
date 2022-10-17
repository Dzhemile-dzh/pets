<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/6/2016
 * Time: 4:48 PM
 */
namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class TopDraw extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
