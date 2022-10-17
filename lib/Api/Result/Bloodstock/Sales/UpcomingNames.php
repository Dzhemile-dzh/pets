<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 10/20/2016
 * Time: 10:55 AM
 */

namespace Api\Result\Bloodstock\Sales;

class UpcomingNames extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'upcoming_names' => '\Api\Output\Mapper\Bloodstock\Sales\UpcomingNames',
        ];
    }
}
