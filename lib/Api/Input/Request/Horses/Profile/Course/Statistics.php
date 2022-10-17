<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Profile\Course;

use Api\Input\Request\Parameter\Validator;
use Api\Input\Request\Horses\Profile;
use Api\Input\Request\Parameter\Calculate;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Statistics extends Profile
{
    use \Api\Input\Request\Method\GetSeasonDateBegin;
    use \Api\Input\Request\Method\GetSeasonDateEnd;

    const ENTITY_ID = 'courseId';

    protected function setupParameters()
    {
        $this->addNamedParameter(
            self::ENTITY_ID,
            new StandardValidator\SmallInteger()
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
            'raceType',
            new Validator\RaceType(
                $this->getSelectors()
            ),
            false,
            new Calculate\RaceType\Course()
        );

        $this->addValidator(new \Api\Input\Request\Validator\SeasonBeginEndYears());
    }
}
