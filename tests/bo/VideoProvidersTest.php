<?php

namespace Tests\Bo;

use Phalcon\Mvc\Model\Row\General as Row;

class VideoProvidersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array    $raceIDs
     * @param Row|null $expectedResult
     *
     * @dataProvider providerTestGetDetails
     */
    public function testGetDetails($raceIDs, $expectedResult)
    {
        $data = new \Tests\Stubs\Bo\VideoProviders($raceIDs);

        $actualResult = $data->getDetails();
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestGetDetails()
    {
        return [
            [
                array(593972, 593973, 595296, 638856),
                array(
                    537772 =>
                        array(
                            0 =>
                                Row::createFromArray(array(
                                    'race_instance_uid' => 537772,
                                    'ptv_video_id' => 1803205,
                                    'video_provider' => 'ATR',
                                    'complete_race_uid' => 1803205,
                                    'complete_race_start' => 2747,
                                    'complete_race_end' => 2954,
                                    'finish_race_uid' => 1803207,
                                    'finish_race_start' => 2910,
                                    'finish_race_end' => 2954,
                                )),
                        ),
                    593973 =>
                        array(
                            0 =>
                                Row::createFromArray(array(
                                    'race_instance_uid' => 593973,
                                    'ptv_video_id' => 1803205,
                                    'video_provider' => 'RUK',
                                    'complete_race_uid' => 2340580,
                                    'complete_race_start' => 352,
                                    'complete_race_end' => 695,
                                    'finish_race_uid' => 2340581,
                                    'finish_race_start' => 415,
                                    'finish_race_end' => 467,
                                )),
                        ),
                    595296 =>
                        array(
                            0 =>
                                Row::createFromArray(array(
                                    'race_instance_uid' => 595296,
                                    'ptv_video_id' => 40979,
                                    'video_provider' => 'ATR',
                                    'complete_race_uid' => 2340580,
                                    'complete_race_start' => 0,
                                    'complete_race_end' => 1,
                                    'finish_race_uid' => 40979,
                                    'finish_race_start' => 0,
                                    'finish_race_end' => 1,
                                )),
                        ),
                ),
            ]
        ];
    }
}
