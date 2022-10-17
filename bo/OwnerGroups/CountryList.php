<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Api\DataProvider\Bo\OwnerGroups\CountryList as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\CountryList as Request;

/**
 * Class HorseList
 *
 * @property Request $request
 *
 * @package Bo\OwnerGroups
 */
class CountryList extends Standart
{
    /**
     * @return array
     */
    public function getData()
    {
        return (new DataProvider())->getData($this->request->getOwnerGroupId());
    }
}
