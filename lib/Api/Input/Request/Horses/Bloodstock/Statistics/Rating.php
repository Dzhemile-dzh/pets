<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 3/29/2016
 * Time: 12:29 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Statistics;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Parameter\Validator\HorseAge;

class Rating extends \Api\Input\Request\Horses\Bloodstock\Statistics
{
    use \Api\Input\Request\Method\GetSeasonDateBegin;
    use \Api\Input\Request\Method\GetSeasonDateEnd;
    use \Api\Input\Request\Method\GetSeasonTypeCode;
    use \Api\Input\Request\Method\GetRaceTypeCodes;

    /**
     * @var array
     */
    protected static $availableCountryCodes = ['Europe', 'All', 'GB', 'GB-IRE'];

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'countryFlag',
            new StandardValidator\ExistsInArray(
                static::getAvailableCountryCodes()
            ),
            true
        );

        $this->addNamedParameter(
            'seasonYearBegin',
            new StandardValidator\Integer(),
            false
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'seasonYearEnd',
            new StandardValidator\Integer(),
            false
        );
        $this->addCast('seasonYearEnd', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getRaceTypeKeys()
            ),
            false
        );

        $this->addNamedParameter(
            'surface',
            new Validator\Surface(
                $this->getSelectors()
            ),
            false
        );

        $this->addNamedParameter(
            'distance',
            null,
            false
        );

        $this->addNamedParameter(
            'age',
            new HorseAge(['2', '3', '4', '4+', '5', '6', '7', '7+']),
            false
        );
        $this->addCast('age', new Cast\HorseAge());

        $this->addNamedParameter(
            'jumpsCode',
            new Validator\JumpsCode(
                $this->getSelectors()
            ),
            false
        );

        $this->addNamedParameter(
            'number',
            new Validator\Number(),
            false
        );
        $this->addCast('number', new Cast\DecimalInteger());

        $this->addValidator(new \Api\Input\Request\Validator\BloodstockStatisticsRequired());
        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndYears());
        $this->addValidator(new \Api\Input\Request\Validator\SeasonalStatisticsYearRange());
        $this->addValidator(new \Api\Input\Request\Validator\RaceDistances($this->getSelectors(), $this->getRaceType(), 1013));
        $this->addValidator(new \Api\Input\Request\Validator\BloodstockStatisticsParamsCombinations($this->getSelectors(), 'bloodstock_horse'));
        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndDates());
    }
}
