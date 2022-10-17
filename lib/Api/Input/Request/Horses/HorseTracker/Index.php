<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\HorseTracker;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Validator\RaceType as RaceTypeValidator;
use Api\Input\Request\Parameter\Validator\HorseAge;

/**
 * @method mixed getUserId() Returns user id
 */
class Index extends \Api\Input\Request\HorsesRequest
{
    use \Api\Input\Request\Method\GetRaceTypeCodes;

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'userId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('userId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getRaceTypeKeys()
            ),
            false
        );

        $this->addNamedParameter(
            'jumpsCode',
            new Validator\JumpsCode(
                $this->getSelectors()
            ),
            false
        );

        $this->addNamedParameter(
            'age',
            new HorseAge(['2', '3', '4', '4+', '5', '6', '7', '7+']),
            false
        );
        $this->addCast('age', new Cast\HorseAge());
        
        $this->addValidator(new RaceTypeValidator(RaceTypeValidator::JUMPS_CODE));
    }
}
