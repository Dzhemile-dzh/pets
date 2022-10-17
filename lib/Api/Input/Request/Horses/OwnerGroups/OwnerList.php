<?php

namespace Api\Input\Request\Horses\OwnerGroups;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * @method int getOwnerGroupId()
 *
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class OwnerList extends HorsesRequest
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
    }
}
