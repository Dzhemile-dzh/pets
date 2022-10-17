<?php

namespace Api\Input\Request\Horses\OwnerGroups;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\Integer;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * Class HorseList
 *
 * @method int getOwnerGroupId()
 * @method int getOwnerId()
 * @method int getTrainerId()
 * @method string getTrainerCountryCode()
 *
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class HorseList extends HorsesRequest
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
            'trainerCountryCode',
            new StringLength(2, 3),
            false
        );
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
    public function isTrainerCountryCodeProvided(): bool
    {
        return $this->isParameterProvided('trainerCountryCode');
    }
}
