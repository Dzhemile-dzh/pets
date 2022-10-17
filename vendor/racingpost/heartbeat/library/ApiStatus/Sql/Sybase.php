<?php

namespace ApiStatus\Sql;

use Phalcon\Db\Adapter\Sybase as Adapter;
use Phalcon\Mvc\Model\Resultset\Multiple;
use Phalcon\Mvc\Model\Resultset\MultipleEntry;
use Phalcon\Mvc\Model\Row\General;

/**
 * Class Status
 * Class is intended to produce info about of Sybase status.
 * It uses routine 'sp__tsnap' to obtain information (@see:
 * https://sites.google.com/a/racingpost.com/racing-post-it-documentation-centre/development-standards-and-guidelines/database-development-standards/ase-clustered-edition/ase-15-heartbeat-monitoring).
 * We use builtin function 'sybase_routine_call' to produce need us outcomes, but by imperative way was found that a
 * call of specified above function does not produce any data, instead, it cause PHP Warning containing needed us info.
 *
 * @package ApiStatus\Sybase
 */
abstract class Sybase extends \ApiStatus\Status
{
    const ROUTINE_COMMAND = "EXEC sp__tsnap U&'hbeat'";
    const UNDEFINED_STATUS = "Unexpected behavior of sp__tsnap routine";
    const FAILURE_CONNECTION_STATUS = "Can not connect to Sybase";
    const FAILURE_EXECUTION_SP = "Cannot execute stored procedure.";
    const SUCCESS_CONNECTION_STATUS = "Successful connect to Sybase";
    const DELIMITER_SERVER_VARS = ';';

    /**
     * @var array
     */
    protected $statuses = [
        'nodes' => null,
        'healthy' => null,
    ];

    /**
     * @param Adapter $connection
     */
    abstract protected function actionBeforeRoutineCall($connection);

    /**
     * @param \stdClass $status
     */
    abstract protected function setNodeStatus($status);

    /**
     * @param  array $routineResult
     *
     * @return boolean
     */
    abstract protected function retrieveStatus(array $routineResult);

    /**
     * @inheritdoc
     */
    protected function obtainStatuses()
    {
        $this->loopByNodes();
        $this->statuses['healthy'] = (bool)$this->statuses['healthy'];
        $this->statuses = (Object)$this->statuses;
    }

    /**
     * @inheritdoc
     */
    private function loopByNodes()
    {
        foreach ($this->getConnectionParameters() as $parameters) {
            $this->setNodeStatus($this->getNodeStatus($parameters));
        }
    }

    /**
     * @param array $connParams
     *
     * @return string
     * @throws \Phalcon\Db\Exception
     */
    private function getNodeStatus(array $connParams)
    {
        $status = ['node_name' => $connParams['servername'], 'routine_result' => null];
        $healthy = false;

        try {
            $connection = new Adapter($connParams);

            $this->actionBeforeRoutineCall($connection);

            try {
                $res = $connection->query(static::ROUTINE_COMMAND);

                $sets = new Multiple(
                    $res,
                    new MultipleEntry(
                        new General()
                    )
                );
                $sets->fetchAll();

                $arrStatus = $this->getStatusArray($sets);
                if (empty($arrStatus)) {
                    $status['info'] = self::UNDEFINED_STATUS;
                    $healthy = false;
                } else {
                    $status['info'] = self::SUCCESS_CONNECTION_STATUS;
                    $status['routine_result'] = (Object)$arrStatus;
                    $healthy = $this->retrieveStatus($arrStatus);
                }
            } catch (\Exception $e) {
                $status['info'] = self::FAILURE_EXECUTION_SP;
                $healthy = false;
            }
        } catch (\Exception $e) {
            $status['info'] = self::FAILURE_CONNECTION_STATUS;
        } finally {
            $status['healthy'] = $healthy;
            return (Object)$status;
        }
    }

    /**
     * @param $sets
     *
     * @return array
     */
    protected function getStatusArray($sets)
    {
        $statusArray = [];
        if (isset($sets[1][0])) {
            foreach ($sets[1][0] as $name => $value) {
                $statusArray[str_replace(['/', ' ', '>'], '_', $name)] = $value;
            }
        }
        return $statusArray;
    }

    /**
     * We expect that Server variables will be specified in the style described below:
     *    SetEnv AUTH_NODES_SERVERNAME_API_HORSES "RPC113_1;RPC113_2"
     *    SetEnv AUTH_NODES_PASSWORD_API_HORSES "****;****"
     *    SetEnv AUTH_NODES_USERNAME_API_HORSES "HEARTBEAT_113_1;HEARTBEAT_113_2"
     *
     * @return \Generator
     */
    protected function getConnectionParameters()
    {
        $nodes = $this->getConfig()->get('nodes', null);
        if (is_object($nodes) && isset($nodes->servername) && isset($nodes->password) && isset($nodes->username)) {
            $serverNames = explode(self::DELIMITER_SERVER_VARS, $nodes->servername);
            $passwords = explode(self::DELIMITER_SERVER_VARS, $nodes->password);
            $userNames = explode(self::DELIMITER_SERVER_VARS, $nodes->username);
            $count = count($serverNames);
            if ($count === count($passwords) && $count === count($userNames)) {
                $connAttrs = $this->getConfig()->get('database', null);
                if (isset($connAttrs, $connAttrs->name, $connAttrs->persistent, $connAttrs->usePreparedStatements)) {
                    for ($i = 0; $i < $count; $i++) {
                        yield [
                            "servername" => $serverNames[$i],
                            "username" => $userNames[$i],
                            "password" => $passwords[$i],
                            "dbname" => $connAttrs->name,
                            "persistent" => (bool)(int)$connAttrs->persistent,
                            "usePreparedStatements" => (bool)(int)$connAttrs->usePreparedStatements
                        ];
                    }
                }
            }
        }
    }
}
