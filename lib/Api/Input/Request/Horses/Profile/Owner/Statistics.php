<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/10/2015
 * Time: 4:23 PM
 */

namespace Api\Input\Request\Horses\Profile\Owner;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Statistics extends Profile
{
    use \Api\Input\Request\Method\GetSeasonDateBegin;
    use \Api\Input\Request\Method\GetSeasonDateEnd;

    const ENTITY_ID = 'ownerId';

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
                $this->getSelectors()->getStatisticsTypeCodeKeys('owner')
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

        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndYears());
        $this->addValidator(new \Api\Input\Request\Validator\CountryRaceTypeSurface($this->getSelectors()));
        $this->addValidator(new \Api\Input\Request\Validator\StatsRaceTypeDependent());
    }
}
