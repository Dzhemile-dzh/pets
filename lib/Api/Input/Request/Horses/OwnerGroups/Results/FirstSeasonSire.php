<?php

namespace Api\Input\Request\Horses\OwnerGroups\Results;

use Api\Input\Request\Horses\OwnerGroups\Results;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Api\Constants\Horses as Constants;

/**
 * Class Results
 *
 * @method int getOwnerGroupId()
 * @method int getOwnerId()
 * @method int getTrainerId()
 * @method string getTrainerCountryCode()
 *
 * @package Api\Input\Request\Horses\OwnerGroups
 */
class FirstSeasonSire extends Results
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        // We set minLength of the string to be 1 because we want group name to not be empty
        $this->addNamedParameter(
            'firstSeasonSireGroupName',
            new StandardValidator\ExistsInArray(array_keys(Constants::IDS_OF_OWNER_GROUPS))
        );

        $this->addNamedParameter(
            'startDate',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            false,
            $this->getDefaultStartDate()
        );
        $this->addNamedParameter(
            'endDate',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            false,
            $this->getDefaultEndDate()
        );
    }
}
