<?php

namespace Tests\Logger;

use Rp\Formatter;
use Rp\Logger;
use Tests\Stubs\Formatter\Message;

/**
 * Class FormatterTest
 * @package Tests\Logger
 */
class FormatterTest extends \PHPUnit\Framework\TestCase
{
    protected $requestMethod;
    protected $httpHost;
    protected $requestUri;

    protected function setUp()
    {
        $this->requestMethod        = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;
        $this->httpHost             = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
        $this->requestUri           = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;

        $_SERVER['REQUEST_METHOD']  = 'TEST_REQUEST_METHOD';
        $_SERVER['HTTP_HOST']       = 'TEST_HTTP_HOST';
        $_SERVER['REQUEST_URI']     = 'TEST_REQUEST_URI';
    }

    protected function tearDown()
    {
        $_SERVER['REQUEST_METHOD']  = $this->requestMethod;
        $_SERVER['HTTP_HOST']       = $this->httpHost;
        $_SERVER['REQUEST_URI']     = $this->requestUri;
    }


    /**
     * @param       $expectedMessage
     * @param array $data
     *
     * @dataProvider dataProviderTestFormat
     */
    public function testFormat($expectedMessage, array $data)
    {
        $mock = $this->getMockBuilder('\Tests\Stubs\Formatter')
            ->setConstructorArgs([$data['requestTag'], $data['microtime']])
            ->setMethods(['formatDate'])
            ->getMock();
        $mock->expects($this->any())->method('formatDate')->willReturn($data['date']);

        $this->assertEquals($expectedMessage, $mock->format($data['message'], $data['level'], $data['timestamp'], $data['context']));
    }

    /**
     * @return array
     */
    public function dataProviderTestFormat()
    {


        return [
            [
                '2016-12-02 11:13:42.711 - DEBUG - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - debug message' . PHP_EOL,
                [
                    'microtime'     => '0.71106700 1480670022',
                    'date'          => '2016-12-02 11:13:42.711',
                    'message'       => 'debug message',
                    'level'         => \Phalcon\Logger::DEBUG,
                    'timestamp'     => '1480583875',
                    'context'       => null,
                    'requestTag'    => '0123456789',
                ]
            ],
            [
                '2016-12-02 11:13:42.700 - INFO - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - info message' . PHP_EOL,
                [
                    'microtime'     => '0.70006700 1480670022',
                    'date'          => '2016-12-02 11:13:42.700',
                    'message'       => 'info message',
                    'level'         => \Phalcon\Logger::INFO,
                    'timestamp'     => '1480583875',
                    'context'       => null,
                    'requestTag'    => '0123456789',
                ]
            ],
            [
                '2016-12-02 11:13:42.700 - INFO - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - info message with context one' . PHP_EOL,
                [
                    'microtime'     => '0.70006700 1480670022',
                    'date'          => '2016-12-02 11:13:42.700',
                    'message'       => 'info message with context %s',
                    'level'         => \Phalcon\Logger::INFO,
                    'timestamp'     => '1480583875',
                    'context'       => ['one'],
                    'requestTag'    => '0123456789',
                ]
            ],
            [
                '2016-12-02 11:13:42.700 - INFO - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - info message with context one two' . PHP_EOL,
                [
                    'microtime'     => '0.70006700 1480670022',
                    'date'          => '2016-12-02 11:13:42.700',
                    'message'       => 'info message with context %s %s',
                    'level'         => \Phalcon\Logger::INFO,
                    'timestamp'     => '1480583875',
                    'context'       => ['one', 'two'],
                    'requestTag'    => '0123456789',
                ]
            ],
            [
                '2016-12-02 11:13:42.700 - INFO - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - info message with object stdClass::testMethod()' . PHP_EOL,
                [
                    'microtime'     => '0.70006700 1480670022',
                    'date'          => '2016-12-02 11:13:42.700',
                    'message'       => 'info message with object %s',
                    'level'         => \Phalcon\Logger::INFO,
                    'timestamp'     => '1480583875',
                    'context'       => [[new \stdClass(), 'testMethod']],
                    'requestTag'    => '0123456789',
                ]
            ],
            [
                '2016-12-02 11:13:42.700 - INFO - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - info message with object stdClass::testMethod(testParam1, testParam2)' . PHP_EOL,
                [
                    'microtime'     => '0.70006700 1480670022',
                    'date'          => '2016-12-02 11:13:42.700',
                    'message'       => 'info message with object %s',
                    'level'         => \Phalcon\Logger::INFO,
                    'timestamp'     => '1480583875',
                    'context'       => [[new \stdClass(), 'testMethod', 'testParam1', 'testParam2']],
                    'requestTag'    => '0123456789',
                ]
            ],
            [
                '2016-12-02 11:13:42.700 - INFO - TEST_REQUEST_METHOD: TEST_HTTP_HOST TEST_REQUEST_URI - [0123456789] - info message with object callback: internal_message' . PHP_EOL,
                [
                    'microtime'     => '0.70006700 1480670022',
                    'date'          => '2016-12-02 11:13:42.700',
                    'message'       => 'info message with object %s',
                    'level'         => \Phalcon\Logger::INFO,
                    'timestamp'     => '1480583875',
                    'context'       => [[new Message(), 'message', 'internal_message']],
                    'requestTag'    => '0123456789',
                ]
            ]
        ];
    }

    /**
     * @param       $expectedFormattedDate
     * @param array $data
     *
     * @dataProvider dataProviderTestFormatDate
     */
    public function testFormatDate($expectedFormattedDate, array $data)
    {
        $formatter = new \Tests\Stubs\Formatter('',null);
        $this->assertEquals($expectedFormattedDate, $formatter->formatDate($data['microtime']));
    }

    /**
     * @return array
     */
    public function dataProviderTestFormatDate()
    {
        return [
            [
                '2016-12-02 09:13:42.700',
                [
                    'microtime' => '0.70006700 1480670022'
                ]
            ],
            [
                '2016-12-02 09:13:42.712',
                [
                    'microtime' => '0.71206700 1480670022'
                ]
            ],
            [
                '2016-12-02 09:13:42.002',
                [
                    'microtime' => '0.00206700 1480670022'
                ]
            ]
        ];
    }
}
