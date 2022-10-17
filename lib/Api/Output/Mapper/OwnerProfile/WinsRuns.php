<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 9/20/2016
 * Time: 3:59 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

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
