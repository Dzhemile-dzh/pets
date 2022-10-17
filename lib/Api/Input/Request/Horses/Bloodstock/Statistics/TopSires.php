<?php

namespace Api\Input\Request\Horses\Bloodstock\Statistics;

use Api\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Validator\RaceType as RaceTypeValidator;

/**
 * Class TopSires
 * @package Api\Input\Request\Horses\Bloodstock\Statistics
 * @method getSeason()
 * @method getRaceType()
 * @method getCountryCodes()
 */
class TopSires extends \Api\Input\Request\Horses\Bloodstock\Statistics
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'season',
            new StandardValidator\IntegerId(),
            false,
            date("Y")
        );
        $this->addCast('season', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray($this->getSelectors()->getRaceTypeKeys()),
            false,
            'flat'
        );

        $this->addNamedParameter(
            'countryCodes',
            new StandardValidator\ArrayParameter(
                new StandardValidator\ExistsInArray(static::getAvailableCountryCodes())
            ),
            false
        );

        $this->addNamedParameter(
            'jumpsCode',
            new StandardValidator\ArrayParameter(
                new Validator\JumpsCode($this->getSelectors())
            ),
            false
        );

        $this->addValidator(new RaceTypeValidator(RaceTypeValidator::JUMPS_CODE));
    }
}
