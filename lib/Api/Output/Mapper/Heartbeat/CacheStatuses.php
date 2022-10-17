<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/24/2016
 * Time: 2:47 PM
 */

namespace Api\Output\Mapper\Heartbeat;

use Phalcon\DI;

class CacheStatuses extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return DI::getDefault()->getShared('heartbeat')->getMapper('cache', 'statuses');
    }
}
