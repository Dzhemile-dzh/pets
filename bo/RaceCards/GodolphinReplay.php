<?php

namespace Bo\RaceCards;

use GuzzleHttp\ClientInterface as GuzzleHttp;
use Zend\Diactoros\Request as PsrRequest;

/**
 * Class GodolphinReplay
 *
 * @package Bo\RaceCards
 */
class GodolphinReplay
{
    private const GODOLPHIN_REPLAY_URL = 'https://assets.rpb2b.com/godolphin/videos/{RACE_ID}.mp4';

    private $guzzle;

    public function __construct(GuzzleHttp $httpClient)
    {
        $this->guzzle = $httpClient;
    }

    /**
     * @param int $raceId
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function checkRaceReplay(int $raceId): string
    {
        $url = str_replace('{RACE_ID}', $raceId, self::GODOLPHIN_REPLAY_URL);

        $request = new PsrRequest($url, 'GET');

        // We need to check if a video exists
        // if it doesn`t exists status will be 403 and guzzle will throw an exception
        try {
            $this->guzzle->send($request);
        } catch (\Exception $exception) {
            if (!is_null($exception->getResponse()) && $exception->getResponse()->getStatusCode() == 403) {
                return 'false';
            } else {
                throw $exception;
            }
        }

        return 'true';
    }
}
