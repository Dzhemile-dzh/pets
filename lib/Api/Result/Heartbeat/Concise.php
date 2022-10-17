<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/8/2016
 * Time: 4:51 PM
 */

namespace Api\Result\Heartbeat;

use Phalcon\DI;

class Concise extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        $mappers = [
            'redis' => '\Api\Output\Mapper\Heartbeat\Cache',
            'replication_state' => '\Api\Output\Mapper\Heartbeat\SybaseReplication',
            'server_variables' => '\Api\Output\Mapper\Heartbeat\ServerVariables',
        ];

        $replication = DI::getDefault()->getShared('heartbeat')->getReplication()->getStatuses();
        if ($replication->healthy) {
            $mappers['replication_state.replication.routine_result'] = '\Api\Output\Mapper\Heartbeat\SybaseReplicationRoutineResult';
        }

        $statuses = DI::getDefault()->getShared('heartbeat')->getCache()->getStatuses();
        if ($statuses->healthy) {
            $mappers['redis.statuses'] = '\Api\Output\Mapper\Heartbeat\CacheStatuses';
        }

        return $mappers;
    }
}
