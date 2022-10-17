<?php
namespace Api\Input\Request\Horses\SeasonalStatistics;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\SeasonalStatistics as GeneralSeason;
use Api\Input\Request\Validator as RequestValidator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class FirstCrop extends \Api\Input\Request\HorsesRequest
{
    use \Api\Input\Request\Method\GetSeasonDateBegin;
    use \Api\Input\Request\Method\GetSeasonDateEnd;
    use \Api\Input\Request\Method\GetSeasonTypeCode;
    use \Api\Input\Request\Method\GetRaceTypeCodes;

    const RACE_TYPE = 'flat';

    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
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
            'going',
            new Validator\GoingType(
                $this->getSelectors()
            ),
            false
        );

        $this->addValidator(
            new \Api\Input\Request\Validator\RaceDistances($this->getSelectors(), self::RACE_TYPE, 1013)
        );

        $this->addNamedParameter(
            'progenyPerformersLimit',
            new StandardValidator\SmallInteger(),
            false,
            10
        );
        $this->addCast('progenyPerformersLimit', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'countryCodes',
            new StandardValidator\ArrayParameter(
                new StandardValidator\ExistsInArray(['GB', 'IRE'])
            ),
            false,
            ['GB', 'IRE']
        );

        $this->addNamedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getRaceTypeKeys()
            ),
            false,
            self::RACE_TYPE
        );

        $this->addNamedParameter(
            'incEuroRaces',
            new StandardValidator\Boolean(),
            false,
            false
        );
        $this->addCast('incEuroRaces', new Cast\Boolean());
    }

    protected function getRaceType()
    {
        return self::RACE_TYPE;
    }

    protected function getSeasonYearEnd()
    {
        return date('Y');
    }

    protected function getSeasonYearBegin()
    {
        return date('Y');
    }

    protected function getCountryCodes()
    {
        return ['GB', 'IRE'];
    }
}
