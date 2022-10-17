<?php
namespace Api\Input\Request\Horses\SeasonalStatistics;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\SeasonalStatistics as GeneralSeason;
use Api\Input\Request\Validator as RequestValidator;
use Api\Input\Request\Validator\RaceType as RaceTypeValidator;
use Api\Input\Request\Parameter\Calculate;
use Api\Input\Request\Parameter\Calculate\RaceType\SeasonalStatistics as RaceTypeCalculation;
use Api\Input\Request\Parameter\Calculate\Championship as ChampionshipCalculation;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator\HorseAge;

class Jockey extends GeneralSeason
{

    const SEASONAL_STATS_KEY = 'jockey';

    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'seasonYearBegin',
            new Validator\SeasonYear(),
            false,
            new Calculate\SeasonYearBegin()
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new StandardValidator\ExistsInArray($this->getSelectors()->getRaceTypeKeys()),
            false,
            new RaceTypeCalculation()
        );

        $this->addNamedParameter(
            'countryCodes',
            new StandardValidator\ArrayParameter(new StandardValidator\ExistsInArray(['GB', 'IRE'])),
            false,
            [self::DEFAULT_COUNTRY_CODE]
        );
        
        $this->addNamedParameter(
            'surface',
            new Validator\Surface($this->getSelectors()),
            false
        );

        $this->addNamedParameter(
            'championship',
            new StandardValidator\ExistsInArray(["jockey"]),
            false,
            new ChampionshipCalculation(self::SEASONAL_STATS_KEY)
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
            'going',
            new Validator\GoingType($this->getSelectors()),
            false
        );

        $this->addNamedParameter(
            'jumpsCode',
            new Validator\JumpsCode($this->getSelectors()),
            false
        );

        $this->addValidator(new RequestValidator\RaceTypeSurface($this->getSelectors()));
        $this->addValidator(new RequestValidator\SeasonalStatisticsRequired());
        $this->addValidator(new RaceTypeValidator(RaceTypeValidator::JUMPS_CODE));
        $this->addValidator(new RequestValidator\SeasonalStatisticsParamsCombinations($this->getSelectors(), self::SEASONAL_STATS_KEY));
        $this->addValidator(new RequestValidator\RaceDistances($this->getSelectors(), $this->getRaceType(), 1013));
    }
}
