<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/21/2016
 * Time: 6:34 PM
 */

namespace Api\Input\Request\Horses\Profile\Owner;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate;
use Api\Input\Request\Validator\SeasonBeginEndYears as SeasonBeginEndYearsValidator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class RecordByRaceType
 *
 * @method getOwnerId
 *
 * @package Api\Input\Request\Horses\Profile\Owner
 */
class RecordByRaceType extends Profile
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

        $this->addValidator(new SeasonBeginEndYearsValidator());
    }
}
