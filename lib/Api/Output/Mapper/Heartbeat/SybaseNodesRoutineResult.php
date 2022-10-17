<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/29/2016
 * Time: 9:37 AM
 */

namespace Api\Output\Mapper\Heartbeat;

use Phalcon\DI;

class SybaseNodesRoutineResult extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return DI::getDefault()->getShared('heartbeat')->getMapper('sql', 'routine_result');
    }
}
