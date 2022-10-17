<?php

namespace Api\Input\Request\Horses\OwnerGroups;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * @method int getOwnerGroupId()
 * @method int getOwnerGroupLookupId()
 * @method string getDeviceType()
 *
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class Splash extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerGroupId',
            new IntegerId(),
            false
        );
        $this->addCast('ownerGroupId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'ownerGroupLookupId',
            new IntegerId(),
            false
        );
        $this->addCast('ownerGroupLookupId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'deviceType',
            new StringLength(1, 20),
            false
        );
    }
}
