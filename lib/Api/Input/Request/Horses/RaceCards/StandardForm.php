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
 * Class StandardForm
 *
 * @method int getRaceId()
 * @method int getLimit()
 * @method int getReturnP2P()
 *
 * @package Api\Input\Request\Horses\RaceCards
 */
class StandardForm extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'limit',
            new StandardValidator\IntegerId(),
            false,
            6
        );
        $this->addCast('limit', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'returnP2P',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('returnP2P', new Cast\Boolean());
    }
}
