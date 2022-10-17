<?php
namespace Tests\Exception\Loggable;

use Phalcon\Exception\Loggable;

abstract class TestBase extends \Tests\CommonTestCase {
    /**
     * @var \Phalcon\Logger\AdapterInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $logger;

    public function setUp()
    {
        $this->logger = $this->getMockBuilder('\Phalcon\Logger\AdapterInterface')
            ->getMock();
    }

    /**
     * Expect logger method call
     *
     * @param string $method Expected method
     * @param string $message Log message
     * @param array $context Log context
     */
    public function expectsLogWrite($method, $message, $context)
    {
        $this->logger->expects($this->once())
            ->method($method)
            ->with($this->stringContains($message), $context);
    }

    public function errorsData() {
        return [
            [
                'Some error data',
                []
            ],
            [
                'Another message',
                ['Param 1']
            ],
            [
                'Other big message',
                ['Param 1', [$this, 'method'], 321512]
            ]
        ];
    }
}