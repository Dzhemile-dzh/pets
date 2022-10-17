<?php

namespace Tests\Result;

use Api\Result\JsonP;
use Phalcon\Http\Response;

/**
 * @package Tests\Result
 */
class JsonPTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $data
     * @param $expectedOutput
     *
     * @throws \Exception
     * @dataProvider dataProvider
     */
    public function testJsonPSuccess($data, $expectedOutput)
    {
        $jsonPResult = new JsonP("func");
        $jsonPResult->setData($data);

        $response = new Response();
        $jsonPResult->proceedResponse($response);

        $this->assertEquals(
            $expectedOutput,
            $response->getContent()
        );

        $headers = $response->getHeaders();
        $this->assertEquals($headers->get("Content-Type"), "application/javascript");
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                [
                    ['country' => 'IRE', 'horseName' => 'Goggy'],
                    ['country' => 'GB', 'horseName' => 'Fozzy'],
                    ['country' => 'GB', 'horseName' => 'Rozzy'],
                ],
                'func({"data":[{"country":"IRE","horseName":"Goggy"},{"country":"GB","horseName":"Fozzy"},{"country":"GB","horseName":"Rozzy"}],"status":200});'
            ]
        ];
    }
}
