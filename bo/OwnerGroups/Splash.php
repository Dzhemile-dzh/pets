<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Api\DataProvider\Bo\OwnerGroups\Splash as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\Splash as Request;

/**
 * @property Request $request
 *
 * @package Bo\OwnerGroups
 */
class Splash extends Standart
{
    /**
     * @return array|null
     */
    public function getData()
    {
        return (new DataProvider())->getData($this->request);
    }
}
