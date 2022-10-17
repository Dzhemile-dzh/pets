<?php

namespace Tests\ApiStatus;

/**
 * Class StatusTest
 * @package Tests\ApiStatus
 */
class StatusTest extends \PHPUnit\Framework\TestCase
{
     /**
     * @expectedException \TypeError
     */
    public function testConstructFailure()
    {
        new StatusMock([]);
    }

    /**
     * @inheritdoc
     */
    public function testGetStatuses()
    {
        $status = new StatusMock(new \Phalcon\Config([]));
        $this->assertEquals((Object)['test1' => 'test1', 'test2' => 'test2', 'healthy' => true], $status->getStatuses());
    }
}
