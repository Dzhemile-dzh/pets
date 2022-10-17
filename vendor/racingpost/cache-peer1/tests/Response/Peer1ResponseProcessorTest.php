<?php

namespace Tests\Response;

use Phalcon\Cache\Response\Peer1ResponseProcessor;
use Phalcon\Cache\Strategy\ZipStorageStrategy;
use Phalcon\Http\Response;

class Peer1ResponseProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerResponseToCache
     * @param Response $response
     */
    public function testResponseToCache(Response $response, $expected)
    {
        $_SERVER['REQUEST_URI'] = 'http://test.loc';

        $c2r = new Peer1ResponseProcessor();
        $data = $c2r->responseToCache($response);
        $this->prepareComparison($expected, $data);
        $this->assertEquals($expected, $data);
    }

    public function providerResponseToCache()
    {
        $response=  new \Phalcon\Http\Response();
        $response->setStatusCode(200, "OK");
        $response->setHeader("Content-Type", "text/html");
        $response->setContent("<html><body>Hello</body></html>");

        return [
            [
                $response,
                'HTTP/1.1 200 OK:
Status:200 OK
Content-Type:text/html
X-RP-Generated:' . date('Y-m-d H:i:s') . '
X-RP-INT-RequestURL:http://test.loc

<html><body>Hello</body></html>'
            ]
        ];
    }

    /**
     * @param string $cache
     * @param $expected
     * @dataProvider providerCacheToResponse
     */
    public function testCacheToResponse($cache, $expected)
    {
        $_SERVER['REQUEST_URI'] = 'http://test.loc';

        $c2r = new Peer1ResponseProcessor();
        $data = $c2r->cacheToResponse($cache);
        $this->prepareComparison($expected, $data);
        $this->assertEquals($expected, $data);
    }

    public function providerCacheToResponse()
    {
        $response=  new \Phalcon\Http\Response();
        $response->setStatusCode(200, "OK");
        $response->setHeader("Content-Type", "text/html");
        $response->setHeader("X-RP-Generated", date('Y-m-d H:i:s'));
        $response->setHeader("X-RP-INT-RequestURL", 'http://test.loc');
        $response->setContent("<html><body>Hello</body></html>");

        return [
            [
                'HTTP/1.1 200 OK:
Status:200 OK
Content-Type:text/html
X-RP-Generated:' . date('Y-m-d H:i:s') . '
X-RP-INT-RequestURL:http://test.loc

<html><body>Hello</body></html>',
                $response
            ]
        ];
    }

    /**
     * @param Response $response
     * @param $expected
     * @dataProvider providerPackResponseToCache
     */
    public function testPack(Response $response, $expected)
    {
        $_SERVER['REQUEST_URI'] = 'http://test.loc';

        $c2r = new Peer1ResponseProcessor(new ZipStorageStrategy());
        $data = $c2r->responseToCache($response);
        $data = $c2r->cacheToResponse($data);
        $this->prepareComparison($expected, $data);
        $this->assertEquals($expected, $data);
    }

    public function providerPackResponseToCache()
    {
        $response=  new \Phalcon\Http\Response();
        $response->setStatusCode(200, "OK");
        $response->setHeader("Content-Type", "text/html");
        $response->setContent("<html><body>Hello</body></html>");

        $cachedResponse = clone $response;
        $cachedResponse->setHeader('X-RP-Generated', date('Y-m-d H:i:s'));
        $cachedResponse->setHeader('X-RP-INT-RequestURL', 'http://test.loc');

        return [
            [
                $response,
                $response
            ]
        ];
    }

    /**
     * Due to excecution time we may get fail because actual date can be different between 2 calls date() function
     * @param $expected
     * @param $actual
     */
    private function prepareComparison(&$expected, &$actual)
    {
        $headerName = 'X-RP-Generated';
        $aTime = $eTime = 0;
        $time = date('Y-m-d : H:i:s');

        if (($actual instanceof Response) && ($expected instanceof Response)) {
            $actualHeader = $actual->getHeaders()->get($headerName);
            $expectedHeader = $expected->getHeaders()->get($headerName);
            $aTime = strtotime($actualHeader);
            $eTime = strtotime($expectedHeader);

            $actual->getHeaders()->set($headerName, $time);
            $expected->getHeaders()->set($headerName, $time);
        } elseif (is_string($actual) && is_string($expected)) {
            $pattern = "|{$headerName}:(.*)|";

            preg_match($pattern, $actual, $matchesA);
            preg_match($pattern, $expected, $matchesE);

            if (isset($matchesA[1]) && isset($matchesE[1])) {
                $aTime = strtotime($matchesA[1]);
                $eTime = strtotime($matchesE[1]);

                $expected = preg_replace($pattern, "$headerName:" . $time, $expected);
                $actual = preg_replace($pattern, "$headerName:" . $time, $actual);
            }
        } else {
            $this->fail("Incorrect comparison type");
        }

        if (abs($aTime - $eTime) > 10) {
            $this->fail("Too big difference between dates in {$headerName}");
        }
    }
}
