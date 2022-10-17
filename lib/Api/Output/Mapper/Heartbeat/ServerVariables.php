<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/8/2016
 * Time: 4:53 PM
 */

namespace Api\Output\Mapper\Heartbeat;

use Phalcon\DI;

class ServerVariables extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return DI::getDefault()->getShared('heartbeat')->getMapper('server_vars');
    }
}
