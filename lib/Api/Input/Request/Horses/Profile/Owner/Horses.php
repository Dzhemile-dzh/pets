<?php
/**
 * Created by PhpStorm.
 * User: Kateryna_Vozniuk
 * Date: 2/12/2015
 * Time: 3:22 PM
 */

namespace Api\Input\Request\Horses\Profile\Owner;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Horses extends Profile
{
    use \Api\Input\Request\Method\GetSeasonDateBegin;

    const ENTITY_ID = 'ownerId';

    /**
     * setup parameters
     */
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

        $this->addValidator(new \Api\Input\Request\Validator\CountryRaceTypeSurface($this->getSelectors()));
    }
}
