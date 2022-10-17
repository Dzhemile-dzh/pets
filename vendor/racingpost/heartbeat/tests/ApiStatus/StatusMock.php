<?php

namespace Tests\ApiStatus;

/**
 * Class StatusMock
 * @package Tests\ApiStatus
 */
class StatusMock extends \ApiStatus\Status
{
    private $obtainedStatuses;

    /**
     * @param array $obtainedStatuses
     */
    public function setObtainedStatuses($obtainedStatuses)
    {
        $this->obtainedStatuses = $obtainedStatuses;
        $this->obtainStatuses();
    }

    /**
     * @inheritdoc
     */
    public function obtainStatuses()
    {
        $statuses = is_array($this->obtainedStatuses)
            ? $this->obtainedStatuses
            : ['test1' => 'test1', 'test2' => 'test2', 'healthy' => true];
        $this->statuses = (Object)$statuses;
    }
}
