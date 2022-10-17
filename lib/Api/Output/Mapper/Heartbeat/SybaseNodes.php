<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/21/2016
 * Time: 12:37 PM
 */

namespace Api\Output\Mapper\Heartbeat;

use Phalcon\DI;

class SybaseNodes extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return DI::getDefault()->getShared('heartbeat')->getMapper('sql', 'nodes');
    }
}
