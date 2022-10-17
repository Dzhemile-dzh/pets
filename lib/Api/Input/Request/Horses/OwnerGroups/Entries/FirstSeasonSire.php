<?php
/**
 * Created by PhpStorm.
 * User: gpurnarov
 * Date: 29/01/19
 * Time: 16:52
 */

namespace Api\Input\Request\Horses\OwnerGroups\Entries;

use Api\Input\Request\Horses\OwnerGroups\Entries;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\ExistsInArray;
use Phalcon\Input\Request\Parameter\Validator\Boolean;
use Api\Constants\Horses as Constants;

class FirstSeasonSire extends Entries
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {

        $this->addNamedParameter(
            'firstSeasonSireGroupName',
            new ExistsInArray(array_keys(Constants::IDS_OF_OWNER_GROUPS))
        );

        $this->addNamedParameter(
            'includeCalendarRaces',
            new Boolean(),
            false
        );
        $this->addCast('includeCalendarRaces', new Cast\Boolean());
    }

    /**
     * @return bool
     */
    public function isIncludeCalendarRacesProvided(): bool
    {
        return $this->isParameterProvided('includeCalendarRaces');
    }
}
