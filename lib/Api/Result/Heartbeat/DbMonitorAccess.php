<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 3:07 PM
 */

namespace Api\Result\Heartbeat;

use Phalcon\DI;

class DbMonitorAccess extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'access_monitor' => '\Api\Output\Mapper\Heartbeat\AccessMonitor',
        ];
    }
}
