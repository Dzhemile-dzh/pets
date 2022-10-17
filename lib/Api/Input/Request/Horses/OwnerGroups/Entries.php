<?php

namespace Api\Input\Request\Horses\OwnerGroups;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Validator\StartEndDate;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\Boolean;
use Phalcon\Input\Request\Parameter\Validator\Date;
use Phalcon\Input\Request\Parameter\Validator\Integer;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * Class HorseList
 *
 * @method int getOwnerGroupId()
 * @method int getOwnerId()
 * @method int getTrainerId()
 * @method string getCountryCode()
 * @method bool getIncludeCalendarRaces()
 * @method string getStartDate()
 * @method string getEndDate()
 *
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class Entries extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerGroupId',
            new Integer(0,2147483647)
        );
        $this->addCast('ownerGroupId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'ownerId',
            new IntegerId(),
            false
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'trainerId',
            new IntegerId(),
            false
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'countryCode',
            new StringLength(2, 3),
            false
        );

        $this->addNamedParameter(
            'trainerCountryCode',
            new StringLength(2, 3),
            false
        );

        $this->addNamedParameter(
            'includeCalendarRaces',
            new Boolean(),
            false
        );
        $this->addCast('includeCalendarRaces', new Cast\Boolean());

        $this->addNamedParameter(
            'startDate',
            new Date(),
            false
        );

        $this->addNamedParameter(
            'endDate',
            new Date(),
            false
        );
        $this->addValidator(new StartEndDate());
    }

    /**
     * @return bool
     */
    public function isOwnerIdProvided(): bool
    {
        return $this->isParameterProvided('ownerId');
    }

    /**
     * @return bool
     */
    public function isTrainerIdProvided(): bool
    {
        return $this->isParameterProvided('trainerId');
    }

    /**
     * @return bool
     */
    public function isCountryCodeProvided(): bool
    {
        return $this->isParameterProvided('countryCode');
    }

    /**
     * @return bool
     */
    public function isIncludeCalendarRacesProvided(): bool
    {
        return $this->isParameterProvided('includeCalendarRaces');
    }

    /**
     * @return bool
     */
    public function isTrainerCountryCodeProvided(): bool
    {
        return $this->isParameterProvided('trainerCountryCode');
    }

    /**
     * @return bool
     */
    public function isDateRangeProvided(): bool
    {
        return $this->isParameterProvided('startDate') && $this->isParameterProvided('endDate');
    }
}
