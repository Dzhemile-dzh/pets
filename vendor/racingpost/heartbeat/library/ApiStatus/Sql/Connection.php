<?php

namespace ApiStatus\Sql;

/**
 * Class Connection
 * Class is intended to test a connection to the DB.
 * Class depends from "racingpost/phalcon-ext" ^0.2.20
 * @since 1.1.0
 *
 * @package ApiStatus\Sql
 */
class Connection extends \ApiStatus\Status
{
    protected $statuses = [
        'connection' => null,
        'healthy'    => null,
    ];

    /**
     * @inheritdoc
     */
    public function obtainStatuses()
    {
        $this->statuses['connection'] = $this->getConnectionStatus();

        $this->statuses['healthy'] = (bool)$this->statuses['connection']->server_name;

        $this->statuses = (Object)$this->statuses;
    }

    /**
     * @return Object $status
     */
    private function getConnectionStatus()
    {
        $status = [
            "server_name" => null,
            "db_name"     => null
        ];

        if (isset($this->getConfig()->database)
            && isset($this->getConfig()->database->servername)
            && isset($this->getConfig()->database->name)
        ) {
            $status["server_name"] = $this->getConfig()->database->servername;
            $status["db_name"]     = $this->getConfig()->database->name;
        }

        return (Object)$status;
    }
}
