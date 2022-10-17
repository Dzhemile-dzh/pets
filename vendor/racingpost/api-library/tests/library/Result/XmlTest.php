<?php

namespace Tests\Result;

use Api\Result\Json;
use Api\Result\Xml;
use Phalcon\Http\Response;

/**
 * @package Tests\Result
 */
class XmlTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $data
     * @param $expectedOutput
     *
     * @throws \Exception
     * @dataProvider dataProvider
     */
    public function testXmlSuccess($data, $expectedOutput)
    {
        $jsonResult = new Xml();
        $jsonResult->setData($data);

        $response = new Response();
        $jsonResult->proceedResponse($response);

        $this->assertEquals(
            $expectedOutput,
            $response->getContent()
        );

        $headers = $response->getHeaders();
        $this->assertEquals($headers->get("Content-Type"), "application/xml");
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
                '<?xml version="1.0"?>
<root><data><item0><country>IRE</country><horseName>Goggy</horseName></item0><item1><country>GB</country><horseName>Fozzy</horseName></item1><item2><country>GB</country><horseName>Rozzy</horseName></item2></data><status>200</status></root>
'
            ]
        ];
    }
}
