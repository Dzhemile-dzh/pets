<?php

namespace Tests\Result;

use Api\Result\Json;
use Phalcon\Http\Response;

/**
 * @package Tests\Result
 */
class JsonTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $data
     * @param $expectedOutput
     *
     * @throws \Exception
     * @dataProvider dataProviderTestGetJsonSuccess
     */
    public function testJsonSuccess($data, $expectedOutput)
    {
        $jsonResult = new Json();
        $jsonResult->setData($data);

        $response = new Response();
        $jsonResult->proceedResponse($response);

        $this->assertJsonStringEqualsJsonString(
            $response->getContent(),
            $expectedOutput
        );

        $headers = $response->getHeaders();
        $this->assertEquals($headers->get("Content-Type"), "application/json");
    }

    /**
     * @return array
     */
    public function dataProviderTestGetJsonSuccess()
    {
        return [
            [
                [
                    ['country' => 'IRE', 'horseName' => 'Goggy'],
                    ['country' => 'GB', 'horseName' => 'Fozzy'],
                    ['country' => 'GB', 'horseName' => 'Rozzy'],
                ],
                '
                {
                    "data": [
                        {
                            "country": "IRE",
                            "horseName": "Goggy"
                        },
                        {
                            "country": "GB",
                            "horseName": "Fozzy"
                        },
                        {
                            "country": "GB",
                            "horseName": "Rozzy"
                        }
                    ],
                    "status": 200
                }
                '
            ]
        ];
    }
}
