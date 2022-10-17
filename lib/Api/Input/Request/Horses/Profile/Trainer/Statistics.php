<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Profile\Trainer;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Statistics extends Profile
{
    use \Api\Input\Request\Method\GetSeasonDateBegin;
    use \Api\Input\Request\Method\GetSeasonDateEnd;
    use \Api\Input\Request\Method\GetChampionship;

    const ENTITY_ID = 'trainerId';

    protected function setupParameters()
    {
        $this->addNamedParameter(
            self::ENTITY_ID,
            new StandardValidator\IntegerId()
        );
        $this->addCast(self::ENTITY_ID, new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'seasonYearBegin',
            new Validator\SeasonYear(),
            false,
            new Calculate\SeasonYearBegin()
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'seasonYearEnd',
            new Validator\SeasonYear(),
            false,
            new Calculate\SeasonYearEnd()
        );
        $this->addCast('seasonYearEnd', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'countryCode',
            new Validator\CountryCode(),
            false,
            new Calculate\CountryCode()
        );

        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getRaceTypeKeys()
            ),
            false,
            new Calculate\RaceType()
        );

        $this->addOrderedParameter(
            'statisticsTypeCode',
            new StandardValidator\ExistsInArray(
                $this->getSelectors()->getStatisticsTypeCodeKeys('trainer')
            ),
            false,
            'distance'
        );

        $this->addOrderedParameter(
            'surface',
            new Validator\Surface(
                $this->getSelectors()
            ),
            false
        );

        $this->addOrderedParameter(
            'championship',
            new Validator\ChampionshipFlag(),
            false
        );

        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndYears());
        $this->addValidator(new \Api\Input\Request\Validator\SeasonalStatisticsParamsCombinations($this->getSelectors(), 'trainer'));
        $this->addValidator(new \Api\Input\Request\Validator\StatsRaceTypeDependent());
    }
}
