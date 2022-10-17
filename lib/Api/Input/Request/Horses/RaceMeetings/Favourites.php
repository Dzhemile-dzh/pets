<?php

namespace Api\Input\Request\Horses\RaceMeetings;

use \Api\Constants\Horses as Constants;
use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Method\GetRaceTypeCodes;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate\RaceType\RaceMeetings\Favourites as RaceTypeCalculation;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Favourites
 * @method getCourseId
 * @method getSeasonYearBegin
 * @method getSeasonYearEnd
 * @method getRaceType
 *
 * @package Api\Input\Request\Horses\RaceMeetings
 */
class Favourites extends Profile
{
    const ENTITY_ID = 'courseId';

    use GetRaceTypeCodes;

    protected function setupParameters()
    {
        $this->addOrderedParameter(
            self::ENTITY_ID,
            new StandardValidator\IntegerId()
        );
        $this->addCast(self::ENTITY_ID, new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'seasonYearBegin',
            new Validator\SeasonYear()
        );
        $this->addCast('seasonYearBegin', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'seasonYearEnd',
            new Validator\SeasonYear()
        );
        $this->addCast('seasonYearEnd', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceType',
            new Validator\RaceType($this->getSelectors()),
            false,
            new RaceTypeCalculation()
        );

        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndYears());
    }

    public function getSeasonTypeCode()
    {
        return $this->getRaceType() === 'flat' ? Constants::SEASON_TYPE_CODE_FLAT : Constants::SEASON_TYPE_CODE_JUMPS;
    }
}
