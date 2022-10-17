<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Api\DataProvider\Bo\OwnerGroups\OwnerList as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\OwnerList as Request;

/**
 * @property Request $request
 *
 * @package Bo\OwnerGroups
 */
class OwnerList extends Standart
{
    /**
     * @return array|null
     */
    public function getData()
    {
        return (new DataProvider())->getData($this->request);
    }
}
