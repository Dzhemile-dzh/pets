<?php

namespace ApiStatus\Sql\Sybase;

use Phalcon\Db\Adapter\Sybase;

/**
 * Class Replication
 * @package ApiStatus\Sql\Sybase
 */
class Replication extends \ApiStatus\Sql\Sybase
{
    const ROUTINE_COMMAND = "EXEC sp__tsnap U&'hbeat', U&'0'";

    /**
     * @var array
     */
    protected $statuses = [
        'replication' => null,
        'healthy' => null,
    ];

    /**
     * @param Sybase $connection
     */
    protected function actionBeforeRoutineCall($connection)
    {
    }

    /**
     * @param \stdClass $status
     */
    protected function setNodeStatus($status)
    {
        $this->statuses['healthy'] = $status->healthy;
        $this->statuses['replication'] = $status;
    }

    /**
     * @param array $routineResult
     * @return bool
     */
    protected function retrieveStatus(array $routineResult)
    {
        $healthy = false;
        if ($routineResult['__min'] === 'X' || $routineResult['__min'] === 'N') {
            $healthy = true;
        }
        return $healthy;
    }

    /**
     * @inheritdoc
     */
    protected function getConnectionParameters()
    {
        foreach (parent::getConnectionParameters() as $parameter) {
            yield $parameter;
            return;
        }
    }
}
