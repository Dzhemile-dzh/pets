<?php

namespace Tests\ApiStatus;

/**
 * Class FactoryStatusesMock
 * @package Tests\ApiStatus
 */
class FactoryStatusesMock extends \ApiStatus\FactoryStatuses
{
    const EMPTY_STATUS_SQL = "SQL connections are not detected in config";
    const EMPTY_STATUS_STUB = "Success";

    private $dummy;
    private $stub;

    /**
     * @inheritdoc
     */
    protected function buildStatuses()
    {
        $this->setCache(new StatusMock($this->getConfig()));
        $this->setServerVars(new StatusMock($this->getConfig()));
        $this->setSql(new StatusMock($this->getConfig()));
        $this->setReplication(new StatusMock($this->getConfig()));
        $this->setAccessMonitor(new StatusMock($this->getConfig()));
        $this->setDummy(new StatusMock($this->getConfig()));
    }

    /**
     * @return \ApiStatus\Status
     */
    public function getDummy()
    {
        return $this->dummy;
    }

    /**
     * @param \ApiStatus\Status $status
     */
    public function setDummy(\ApiStatus\Status $status)
    {
        $this->dummy = $status;
    }

    /**
     * @return \ApiStatus\Status
     */
    public function getStub()
    {
        return $this->stub;
    }

    /**
     * @param \ApiStatus\Status  $stub
     */
    public function setStub(\ApiStatus\Status $stub)
    {
        $this->stub = $stub;
    }
}
