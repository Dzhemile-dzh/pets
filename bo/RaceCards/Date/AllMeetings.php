<?php

namespace Bo\RaceCards\Date;

use Bo\Standart;
use Api\Exception\InternalServerError;
use Api\DataProvider\Bo\RaceCards\Date\AllMeetings as DataProvider;

/**
 * @package Bo\RaceCards\Date
 */
class AllMeetings extends Standart
{
    /**
     * @return array|null
     * @throws InternalServerError
     */
    public function getData()
    {
        $dp = new DataProvider();
        $dp->setRequest($this->getRequest());

        return $dp->getData();
    }
}
