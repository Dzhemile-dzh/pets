<?php

namespace Api\Input\Request\Horses\OwnerGroups;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\Integer;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * Class TrainerList
 *
 * @method int getOwnerGroupId()
 * @method string getTrainerCountryCode()
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class TrainerList extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerGroupId',
            new Integer(0, 2147483647),
            false
        );
        $this->addCast('ownerGroupId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'ownerId',
            new IntegerId(),
            false
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'trainerCountryCode',
            new StringLength(2, 3),
            false
        );
    }
}
