<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class Entries extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'entries' => '\Api\Output\Mapper\HorseProfile\Entry',
            'entries.jockey_last_14_days' => '\Api\Output\Mapper\HorseProfile\WinsRuns',
        ];
    }
}
