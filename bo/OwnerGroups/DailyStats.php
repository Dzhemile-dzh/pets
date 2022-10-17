<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Api\DataProvider\Bo\OwnerGroups\DailyStats as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\DailyStats as Request;

/**
 * Class DailyStats
 *
 * @property Request $request
 *
 * @package Bo\OwnerGroups
 */
class DailyStats extends Standart
{
    /**
     * @return array
     */
    public function getData()
    {
        return (new DataProvider())->getData($this->request);
    }
}
