<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/13/2016
 * Time: 12:58 PM
 */

namespace Api\Output\Mapper\Heartbeat;

use Phalcon\DI;

class SybaseReplication extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return DI::getDefault()->getShared('heartbeat')->getMapper('replication');
    }
}
