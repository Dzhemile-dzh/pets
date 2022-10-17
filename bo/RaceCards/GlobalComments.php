<?php

namespace Bo\RaceCards;

use Bo\Standart;
use Api\DataProvider\Bo\RaceCards\GlobalComments as DataProvider;
use Api\Input\Request\Horses\RaceCards\GlobalComments as Request;

/**
 * @property Request $request
 *
 * @package Bo\RaceCards
 */
class GlobalComments extends Standart
{
    /**
     * @return array
     */
    public function getData()
    {
        return (new DataProvider())->getData($this->request);
    }
}
