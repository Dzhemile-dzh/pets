<?php
namespace RP\Test\Cache\Core\Enum;

use RP\Cache\Core\Enum\ResponseStatus;

/**
 * Class ResponseStatusTest
 * @package RP\Test\Cache\Core\Enum
 */
class ResponseStatusTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
    public function getSuccessCodes()
    {
        $expected = array (
            '200 OK',
            '201 Created',
            '202 Accepted',
            '203 Non-Authoritative Information',
            '204 No Content',
            '205 Reset Content',
            '206 Partial Content',
            '207 Multi-status',
            '208 Already Reported',
            '226 IM Used',
            '400 Bad Request',
            '401 Unauthorized',
            '402 Payment Required',
            '403 Forbidden',
            '404 Not Found',
            '405 Method Not Allowed',
            '406 Not Acceptable',
            '407 Proxy Authentication Required',
            '408 Request Time-out',
            '409 Conflict',
            '410 Gone',
            '411 Length Required',
            '412 Precondition Failed',
            '413 Request Entity Too Large',
            '414 Request-URI Too Large',
            '415 Unsupported Media Type',
            '416 Requested range not satisfiable',
            '417 Expectation Failed',
            '418 I\'m a teapot',
            '421 Misdirected Request',
            '422 Unprocessable Entity',
            '423 Locked',
            '424 Failed Dependency',
            '425 Unordered Collection',
            '426 Upgrade Required',
            '428 Precondition Required',
            '429 Too Many Requests',
            '431 Request Header Fields Too Large',
            '451 Unavailable For Legal Reasons',
            '499 Client Closed Request',
            '500 Internal Server Error',
            '501 Not Implemented',
            '502 Bad Gateway',
            '503 Service Unavailable',
            '504 Gateway Time-out',
            '505 HTTP Version not supported',
            '506 Variant Also Negotiates',
            '507 Insufficient Storage',
            '508 Loop Detected',
            '510 Not Extended',
            '511 Network Authentication Required',
        );

        $actual = ResponseStatus::getSuccessCodes();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function getErrorCodes()
    {
        $expected = array (
            '400 Bad Request',
            '401 Unauthorized',
            '402 Payment Required',
            '403 Forbidden',
            '404 Not Found',
            '405 Method Not Allowed',
            '406 Not Acceptable',
            '407 Proxy Authentication Required',
            '408 Request Time-out',
            '409 Conflict',
            '410 Gone',
            '411 Length Required',
            '412 Precondition Failed',
            '413 Request Entity Too Large',
            '414 Request-URI Too Large',
            '415 Unsupported Media Type',
            '416 Requested range not satisfiable',
            '417 Expectation Failed',
            '418 I\'m a teapot',
            '421 Misdirected Request',
            '422 Unprocessable Entity',
            '423 Locked',
            '424 Failed Dependency',
            '425 Unordered Collection',
            '426 Upgrade Required',
            '428 Precondition Required',
            '429 Too Many Requests',
            '431 Request Header Fields Too Large',
            '451 Unavailable For Legal Reasons',
            '499 Client Closed Request',
            '500 Internal Server Error',
            '501 Not Implemented',
            '502 Bad Gateway',
            '503 Service Unavailable',
            '504 Gateway Time-out',
            '505 HTTP Version not supported',
            '506 Variant Also Negotiates',
            '507 Insufficient Storage',
            '508 Loop Detected',
            '510 Not Extended',
            '511 Network Authentication Required',
        );

        $actual = ResponseStatus::getErrorCodes();

        $this->assertEquals($expected, $actual);
    }
}