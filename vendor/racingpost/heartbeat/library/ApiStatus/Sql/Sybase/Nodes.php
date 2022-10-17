<?php

namespace ApiStatus\Sql\Sybase;

/**
 * Class Nodes
 * @package ApiStatus\Sql\Sybase
 */
class Nodes extends \ApiStatus\Sql\Sybase
{
    const ROUTINE_COMMAND = "EXEC sp__tsnap U&'hbeat'";

    /**
     * @param \ApiStatus\Sql\source $connection
     */
    protected function actionBeforeRoutineCall($connection)
    {
        // Rewrite this method in descendants if need some additional actions
    }

    /**
     * @param \stdClass $status
     */
    protected function setNodeStatus($status)
    {
        if (!isset($this->statuses['healthy']) || $status->healthy === false) {
            $this->statuses['healthy'] = $status->healthy;
        }
        $this->statuses['nodes'][] = $status;
    }

    /**
     * @param array $routineResult
     * @return bool
     */
    protected function retrieveStatus(array $routineResult)
    {
        return true;
    }
}
