<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 01/11/2017
 * Time: 1:59 PM
 */
namespace Tests;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Bo\RaceCards\GodolphinReplay;

class GodolphinReplayTest extends \PHPUnit\Framework\TestCase
{
    /**
    * @var ClientInterface
    **/
    private $mockGuzzleClient;

    /**
     * @var int
     */
    private $raceId;

    /**
     * To simulate guzzle errors we need some request to be passed to the constructor of exception
     * @var Request
     */
    private $dummyRequest;

    protected function setUp()
    {
        parent::setUp();
        $this->mockGuzzleClient = $this->getMockBuilder(ClientInterface::class)->getMock();
        $this->raceId = 1234;
        $this->dummyRequest = new Request('GET', '');
    }

    public function testFoundReplay()
    {
        $response = new Response();
        $response = $response->withStatus(200);

        $this->mockGuzzleClient
            ->expects(self::once())
            ->method('send')
            ->willReturn($response);

        $bo = new GodolphinReplay($this->mockGuzzleClient);

        self::assertEquals('true', $bo->checkRaceReplay($this->raceId));
    }

    public function testNotFoundReplay()
    {
        $response = new Response();
        $response = $response->withStatus(403);

        $exception = new ClientException(null, $this->dummyRequest, $response);

        $this->mockGuzzleClient
            ->expects(self::once())
            ->method('send')
            ->willThrowException($exception);

        $bo = new GodolphinReplay($this->mockGuzzleClient);

        self::assertEquals('false', $bo->checkRaceReplay($this->raceId));
    }

    /**
     * @expectedException Exception
     */
    public function testConnectionProblem()
    {
        $exception = new ConnectException(null, $this->dummyRequest);

        $this->mockGuzzleClient
            ->expects(self::once())
            ->method('send')
            ->willThrowException($exception);

        $bo = new GodolphinReplay($this->mockGuzzleClient);

        $bo->checkRaceReplay($this->raceId);
    }
}
