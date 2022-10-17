<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/25/2016
 * Time: 11:47 AM
 */

namespace Api\Output\Mapper\Heartbeat;

use Phalcon\DI;

class AccessMonitor extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return DI::getDefault()->getShared('heartbeat')->getMapper('access_monitor');
    }
}
