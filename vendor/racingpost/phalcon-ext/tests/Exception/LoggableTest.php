<?php
namespace Tests\Exception;

use Phalcon\Exception\Loggable;

class LoggableTest extends \Tests\CommonTestCase
{
    /**
     * @var Loggable
     */
    private $exception;

    /**
     * @var \Phalcon\Logger\AdapterInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;

    public function setUp()
    {
        $this->logger = $this->getMockBuilder('\Phalcon\Logger\AdapterInterface')
            ->getMock();

        $this->exception = $this->getMockBuilder('\Phalcon\Exception\Loggable')
            ->setMethods(['logError'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testMessage()
    {
        $this->exception->__construct($this->logger, 'Error message');
        $this->assertContains('Error message', $this->exception->getLogMessage());
    }

    public function testLogger()
    {
        $this->exception->__construct($this->logger);
        $this->assertSame($this->logger, $this->exception->getLogger());
    }

    public function testContext()
    {
        $this->exception->__construct($this->logger, 'Error message', ['Var 1', 'Var 2']);
        $this->assertEquals(['Var 1', 'Var 2'], $this->exception->getContext());
    }
}