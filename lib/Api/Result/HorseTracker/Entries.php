<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/6/2016
 * Time: 6:32 PM
 */

namespace Api\Result\HorseTracker;

class Entries extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'entries' => '\Api\Output\Mapper\HorseTracker\Entry',
            'entries.races' => '\Api\Output\Mapper\HorseTracker\EntryRaces',
        ];
    }
}
