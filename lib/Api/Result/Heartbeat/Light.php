<?php
/**
 * Created by PhpStorm.
 * User: Paul Costello
 * Date: 8/30/2019
 * Time: 2:25 PM
 */

namespace Api\Result\Heartbeat;

use Phalcon\DI;

class Light extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        $mappers = [
            'redis'            => '\Api\Output\Mapper\Heartbeat\Cache',
            'sybase'           => '\Api\Output\Mapper\Heartbeat\Sybase',
            'server_variables' => '\Api\Output\Mapper\Heartbeat\ServerVariables',
        ];

        $statuses = DI::getDefault()->getShared('heartbeat')->getCache()->getStatuses();
        if ($statuses->healthy) {
            $mappers['redis.statuses'] = '\Api\Output\Mapper\Heartbeat\CacheStatuses';
        }

        return $mappers;
    }
}
