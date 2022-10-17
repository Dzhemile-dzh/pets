<?php
namespace Tests\Logger;

use Rp\Logger;
use Rp\Logger\General;

/**
 * Class LoggerTest
 * @package Tests\Logger
 */
class LoggerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|General
     */
    private $loggerAggregate;

    /**
     * @var Logger
     */
    private $logger;

    public function setUp()
    {
        $config = [
            'filename' => null,
            'options' => [
                'mode' => 'a'
            ],
        ];

        $this->loggerAggregate = $this->getMockForAbstractClass('\Phalcon\Logger\Adapter', [], '', true, true, true, ['emergency', 'debug', 'info', 'warning', 'error', 'log', 'notice', 'alert']);

        $this->logger = $this->getMockBuilder('\Rp\Logger')
            ->disableOriginalConstructor()
            ->setMethods(['createAggregateInstance'])
            ->getMock();

        $this->logger->method('createAggregateInstance')->willReturn($this->loggerAggregate);
        $this->logger->__construct($config);
    }

    public function testTrace()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('log')
            ->with(\Phalcon\Logger::SPECIAL, 'Trace message', ['name' => 'value']);

        $this->logger->trace('Trace message', ['name' => 'value']);
    }

    public function testDebug()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('debug')
            ->with('Debug message', ['name' => 'value']);

        $this->logger->debug('Debug message', ['name' => 'value']);
    }

    public function testNotice()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('notice')
            ->with('Notice message', ['name' => 'value']);

        $this->logger->notice('Notice message', ['name' => 'value']);
    }

    public function testAlert()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('alert')
            ->with('Alert message', ['name' => 'value']);

        $this->logger->alert('Alert message', ['name' => 'value']);
    }

    public function testInfo()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('info')
            ->with('Info message');

        $this->logger->info('Info message');
    }

    public function testWarning()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('warning')
            ->with('Warn message', ['name' => 'value']);

        $this->logger->warning('Warn message', ['name' => 'value']);
    }

    public function testError()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('error')
            ->with('Error message', ['name' => 'value']);

        $this->logger->error('Error message', ['name' => 'value']);
    }

    public function testFatal()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('emergency')
            ->with('Fatal message', ['name' => 'value']);

        $this->logger->fatal('Fatal message', ['name' => 'value']);
    }

    public function testEmergency()
    {
        $this->loggerAggregate->expects($this->once())
            ->method('emergency')
            ->with('Emergency message', ['name' => 'value']);

        $this->logger->emergency('Emergency message', ['name' => 'value']);
    }

    public function testLog() {
        $this->loggerAggregate->expects($this->once())
            ->method('log')
            ->with(\Phalcon\Logger::DEBUG, 'Log message', ['name' => 'value']);

        $this->logger->log(\Phalcon\Logger::DEBUG, 'Log message', ['name' => 'value']);
    }

    public function testFindRequestTag()
    {
        $class = new \ReflectionClass($this->logger);
        $method = $class->getMethod('findRequestTag');
        $method->setAccessible(true);

        $result = $method->invokeArgs($this->logger, [[]]);
        $this->assertEquals(Logger::REQUEST_TAG_DEFAULT, $result);

        $result = $method->invokeArgs($this->logger, [['tag' => '0123456789']]);
        $this->assertEquals('0123456789', $result);


        $result = $method->invokeArgs($this->logger, [['incorrect' => '0123456789']]);
        $this->assertEquals(Logger::REQUEST_TAG_DEFAULT, $result);
    }
}
