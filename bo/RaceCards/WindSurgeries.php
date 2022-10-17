<?php

namespace Bo\RaceCards;

use Bo\Standart;
use Api\DataProvider\Bo\RaceCards\WindSurgeries as DataProvider;
use Api\Input\Request\Horses\RaceCards\WindSurgeries as Request;

/**
 * Class WindSurgeries
 *
 * @property Request $request
 *
 * @package Bo\RaceCards
 */
class WindSurgeries extends Standart
{
    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->getDataProvider()->getData($this->request->getRaceId());
    }
}
