<?php

namespace Tests\Stubs\Models\Bo\RaceMeetings;

class Database extends \Models\Bo\Selectors\Database
{

    public function getSeasonDateBegin($dateStart, $type, $currentSeasonFlag = false)
    {
        return 'Jan  1 2011 12:00AM';
    }

    public function getSeasonDateEnd($dateEnd, $type, $currentSeasonFlag = false)
    {
        return 'Dec 31 2015 11:59PM';
    }

    public function getCurrentSeasonDateEnd($type)
    {
        return 'Dec 31 2015 11:59PM';
    }
}
