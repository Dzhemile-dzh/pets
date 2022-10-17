<?php

namespace Tests\Result;

use Tests\Result\Mock\BigJson;

/**
 * @package Tests\Result
 */
class BigJsonTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $data
     *
     * @return BigJson
     */
    private function getMockBigJson($data)
    {
        $mock = new BigJson();
        $mock->setData((Object)[BigJson::ROOT_FIELD_NAME => \SplFixedArray::fromArray($data)]);
        return $mock;
    }

    /**
     * @param $data
     * @param $expectedOutput
     *
     * @dataProvider dataProviderTestGetJsonSuccess
     */
    public function testGetJsonSuccess($data, $expectedOutput)
    {
        $bigJson = $this->getMockBigJson($data);
        $this->assertSame($expectedOutput, $bigJson->getJson());
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
                '{"data":{"rootFieldName":[' .
                '{"country":"IRE","horseName":"Goggy"}' .
                ',{"country":"GB","horseName":"Fozzy"}' .
                ',{"country":"GB","horseName":"Rozzy"}' .
                ']}, "status":200}',
            ],
            [
                [
                    ['country' => 'IRE', 'horseName' => 'Goggy'],
                    ['country' => 'GB', 'horseName' => 'Fozzy'],
                    ['country' => 'GB', 'horseName' => 'Rozzy'],
                    ['country' => 'IRE', 'horseName' => 'Doggy'],
                    ['country' => 'USA', 'horseName' => 'Bob'],
                    ['country' => 'UA', 'horseName' => 'Marusja'],
                    ['country' => 'UA', 'horseName' => 'Vasilisa'],
                ],
                '{"data":{"rootFieldName":' .
                '[{"country":"IRE","horseName":"Goggy"}' .
                ',{"country":"GB","horseName":"Fozzy"}' .
                ',{"country":"GB","horseName":"Rozzy"}' .
                ',{"country":"IRE","horseName":"Doggy"}' .
                ',{"country":"USA","horseName":"Bob"}' .
                ',{"country":"UA","horseName":"Marusja"}' .
                ',{"country":"UA","horseName":"Vasilisa"}' .
                ']}, "status":200}',
            ],
        ];
    }

    /**
     *
     */
    public function testToStringFailure()
    {
        $bigJson = $this->getMockBigJson([['some' => 'data']]);
        $bigJson->setMappers([1, 2]);

        $this->expectException('\LogicException');
        $this->expectExceptionMessage("Wrong mapper for big JSON");
        $bigJson->getJson();
    }
}
