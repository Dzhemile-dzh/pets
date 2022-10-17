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

class StatisticalSummary extends Profile
{
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
            'countryCode',
            new Validator\CountryCode(),
            false,
            new Calculate\CountryCode()
        );

        $this->addOrderedParameter(
            'raceType',
            new Validator\RaceType(
                $this->getSelectors()
            ),
            false,
            new Calculate\RaceType()
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

        $this->addNamedParameter(
            'seasonYearBegin',
            new Validator\SeasonYear(),
            false
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'seasonYearEnd',
            new Validator\SeasonYear(),
            false
        );
        $this->addCast('seasonYearEnd', new Cast\DecimalInteger());

        $this->addValidator(new \Api\Input\Request\Validator\SeasonalStatisticsParamsCombinations($this->getSelectors(), 'trainer'));
        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndYears());
    }
}
