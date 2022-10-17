<?php

use RP\RequestTag;

class RequestTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @dataProvider headers
     * @param array $headers
     * @param string $expected
     */
    public function constructor(array $headers, $expected)
    {
        $className = '\RP\RequestTag';
        $sut = $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->setMethods(['getHeaders', 'sendHeader'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue($headers));

        $sut->expects($this->once())
            ->method('getHeaders');

        $sut->__construct();

        $this->assertAttributeEquals(
            RequestTag::MARKER_HEADER_NAME_DEFAULT,
            'key',
            $sut,
            'constructor is wrong'
        );

        $this->assertAttributeEquals(
            $expected,
            'value',
            $sut,
            'constructor is wrong'
        );
    }

    public function headers()
    {
        return [
            [ // case #1
                [],
                RequestTag::MARKER_DEFAULT
            ],
            [ // case #2
                [RequestTag::MARKER_HEADER_NAME_DEFAULT => '0123456789'],
                '0123456789'
            ],
        ];
    }
}