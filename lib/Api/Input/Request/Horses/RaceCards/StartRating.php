<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class StartRating
 * @package Api\Input\Request\Horses\RaceCards
 * @method getRaceId
 * @method getHorseId
 */
class StartRating extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );

        $this->addNamedParameter(
            'horseId',
            new StandardValidator\IntegerId(),
            false
        );

        $this->addCast('raceId', new Cast\DecimalInteger());
        $this->addCast('horseId', new Cast\DecimalInteger());
    }
}
