<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/16/2015
 * Time: 3:13 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class WinsRuns extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            "runs" => "runs",
            "wins" => "wins",
            "(getPercent)wins,runs" => "percent"
        ];
    }
}
