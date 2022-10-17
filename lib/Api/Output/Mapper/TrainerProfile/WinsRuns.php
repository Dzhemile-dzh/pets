<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\TrainerProfile;

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
